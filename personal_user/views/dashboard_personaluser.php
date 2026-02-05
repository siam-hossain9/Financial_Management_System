<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}
if (isset($_COOKIE["userid"]) && isset($_COOKIE["username"])) {
    $userid = $_COOKIE["userid"];
    $username = $_COOKIE["username"];
}


include '../models/personaluserdb.php';

$mydb = new Model();
$conn = $mydb->OpenConn();
$P_id = $_SESSION["userid"];


$userQuery = $conn->prepare("SELECT P_montlyIncome FROM personal_user WHERE P_id = ?");
$userQuery->bind_param("i", $P_id);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userData = $userResult->fetch_assoc();
$monthlyIncome = $userData['P_montlyIncome'] ?? 0;


$savingsQuery = $conn->prepare("SELECT COALESCE(SUM(s_amount), 0) as total_savings FROM personal_user_savings WHERE P_id = ?");
$savingsQuery->bind_param("i", $P_id);
$savingsQuery->execute();
$savingsResult = $savingsQuery->get_result();
$savingsData = $savingsResult->fetch_assoc();
$totalSavings = $savingsData['total_savings'];


$expenseQuery = $conn->prepare("SELECT COALESCE(SUM(ex_amount), 0) as total_expense FROM personal_user_expense WHERE P_id = ?");
$expenseQuery->bind_param("i", $P_id);
$expenseQuery->execute();
$expenseResult = $expenseQuery->get_result();
$expenseData = $expenseResult->fetch_assoc();
$totalExpense = $expenseData['total_expense'];


$currentBalance = $monthlyIncome + $totalSavings - $totalExpense;


$currentDate = date('Y-m-d');
$startOfWeek = date('d M', strtotime('monday this week'));
$endOfWeek = date('d M', strtotime('sunday this week'));
$weekRange = $startOfWeek . " - " . $endOfWeek;


$weeklySavingsQuery = $conn->prepare("SELECT COALESCE(SUM(s_amount), 0) as weekly_savings FROM personal_user_savings WHERE P_id = ? AND YEARWEEK(s_date) = YEARWEEK(CURDATE())");
$weeklySavingsQuery->bind_param("i", $P_id);
$weeklySavingsQuery->execute();
$weeklySavingsResult = $weeklySavingsQuery->get_result();
$weeklySavingsData = $weeklySavingsResult->fetch_assoc();
$weeklySavings = $weeklySavingsData['weekly_savings'];


$weeklyExpenseQuery = $conn->prepare("SELECT COALESCE(SUM(ex_amount), 0) as weekly_expense FROM personal_user_expense WHERE P_id = ? AND YEARWEEK(ex_date) = YEARWEEK(CURDATE())");
$weeklyExpenseQuery->bind_param("i", $P_id);
$weeklyExpenseQuery->execute();
$weeklyExpenseResult = $weeklyExpenseQuery->get_result();
$weeklyExpenseData = $weeklyExpenseResult->fetch_assoc();
$weeklyExpense = $weeklyExpenseData['weekly_expense'];


$chartData = [];
for ($i = 5; $i >= 0; $i--) {
    $month = date('Y-m', strtotime("-$i months"));
    $monthName = date('M Y', strtotime("-$i months"));
    
    
    $monthSavingsQuery = $conn->prepare("SELECT COALESCE(SUM(s_amount), 0) as month_savings FROM personal_user_savings WHERE P_id = ? AND DATE_FORMAT(s_date, '%Y-%m') = ?");
    $monthSavingsQuery->bind_param("is", $P_id, $month);
    $monthSavingsQuery->execute();
    $monthSavingsResult = $monthSavingsQuery->get_result();
    $monthSavingsData = $monthSavingsResult->fetch_assoc();
    
    
    $monthExpenseQuery = $conn->prepare("SELECT COALESCE(SUM(ex_amount), 0) as month_expense FROM personal_user_expense WHERE P_id = ? AND DATE_FORMAT(ex_date, '%Y-%m') = ?");
    $monthExpenseQuery->bind_param("is", $P_id, $month);
    $monthExpenseQuery->execute();
    $monthExpenseResult = $monthExpenseQuery->get_result();
    $monthExpenseData = $monthExpenseResult->fetch_assoc();
    
    $chartData[] = [
        'month' => $monthName,
        'savings' => $monthSavingsData['month_savings'],
        'expenses' => $monthExpenseData['month_expense']
    ];
}

$conn->close();

include "./subheader_personaluser.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <script src="../script/jquery-3.7.1.js"></script>
    <script src="../script/personalsavings_ajaxjson.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="dashboard-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="dashboard-title">Dashboard</h1>
    <h4 class="user-name">Welcome, <?php echo $_SESSION['username']; ?></h4>

    
    <div class="recent-expense" data-aos="fade-up" data-aos-duration="1000">
        <div class="current-balace-div">
            <h2 class="current-balance-title">CURRENT BALANCE</h2>
            <h3 class="balance-amount">$<?php echo number_format($currentBalance, 2); ?></h3>
        </div>
        <div class="recent-expense-list" id="savingshistory">
            <h3 class="recent-expense-title">Recent Savings</h3>
        </div>
    </div>

  
    <div class="upper-section" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="weekly-summary-title">Weekly Summary</h2>
        <div class="savings-div">
            <h4 class="weekly-date"><?php echo $weekRange; ?></h4>
            <h4 class="weekly-saving-money">$<?php echo number_format($weeklySavings, 2); ?> saving</h4>
        </div>

        <div class="expense-div">
            <h4 class="weekly-date"><?php echo $weekRange; ?></h4>
            <h4 class="weekly-expense-money">$<?php echo number_format($weeklyExpense, 2); ?> expense</h4>
        </div>
    </div>

    
    <div class="lower-section" data-aos="fade-up" data-aos-duration="1000">
        <h2>Savings vs Expenses (Last 6 Months)</h2>
        <canvas id="financeChart"></canvas>
    </div>
</div>


<script>
    
    const chartData = <?php echo json_encode($chartData); ?>;
    
    const months = chartData.map(item => item.month);
    const savingsData = chartData.map(item => parseFloat(item.savings));
    const expensesData = chartData.map(item => parseFloat(item.expenses));

    
    const ctx = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Savings',
                    data: savingsData,
                    borderColor: 'mediumturquoise',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Expenses',
                    data: expensesData,
                    borderColor: 'lightcoral',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });
</script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>
