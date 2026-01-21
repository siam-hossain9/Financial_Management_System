<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}


include '../models/small_business_db.php';

$mydb = new Model();
$conn = $mydb->OpenCon();
$B_id = $_SESSION["userid"];


$userQuery = $conn->prepare("SELECT B_montlyIncome FROM small_business WHERE B_id = ?");
$userQuery->bind_param("i", $B_id);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userData = $userResult->fetch_assoc();
$monthlyIncome = $userData['B_montlyIncome'] ?? 0;


$savingsQuery = $conn->prepare("SELECT COALESCE(SUM(s_amount), 0) as total_savings FROM small_business_savings WHERE B_id = ?");
$savingsQuery->bind_param("i", $B_id);
$savingsQuery->execute();
$savingsResult = $savingsQuery->get_result();
$savingsData = $savingsResult->fetch_assoc();
$totalSavings = $savingsData['total_savings'];


$expenseQuery = $conn->prepare("SELECT COALESCE(SUM(ex_amount), 0) as total_expense FROM small_business_expense WHERE B_id = ?");
$expenseQuery->bind_param("i", $B_id);
$expenseQuery->execute();
$expenseResult = $expenseQuery->get_result();
$expenseData = $expenseResult->fetch_assoc();
$totalExpense = $expenseData['total_expense'];


$currentBalance = $monthlyIncome + $totalSavings - $totalExpense;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Expenses</title>
    <link rel="stylesheet" href="../css/expense_style.css?v=50">
</head>

<body>
<?php include "./subheader_small_business_views.php"; ?>

<div class="expense-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="expense-title">My Expenses</h1>
    <h4 class="user-name">Welcome, <?php echo isset($_SESSION['business_name']) ? htmlspecialchars($_SESSION['business_name']) : 'Business Owner'; ?></h4>

    <div class="page-content-wrapper">
        <div class="add-expense-div">
            <div class="current-balance-div">
                <h2 class="current-balance-title">CURRENT BALANCE</h2>
                <h3 class="balance-amount">$<?php echo number_format($currentBalance, 2); ?></h3>
            </div>

          
            <div class="add-expense">
                <h2 class="add-expense-title">Enter your Expenses</h2>
                <form action="" method="post" class="add-savings-form" id="expences">
                    <div class="getid"><input class="expense-name-input" type="text" id="expense_id" placeholder="Id" disabled></div>
                    <input type="text" class="expense-name-input" id="expense-name" placeholder="Expense name">
                    <input type="text" class="expense-amount-input" id="expense-amount" placeholder="Expense amount">

                    <label for="">Select type</label>
                    <select class="expense-type" id="expense-type">
                        <option selected value=""></option>
                        <option value="technology">Technology</option>
                        <option value="office">Office Space</option>
                        <option value="marketing">Marketing</option>
                        <option value="transport">Transport</option>
                        <option value="others">Others</option>
                    </select>
                    <a class="add-expense-btn" type="submit" id="addexpense" href="#">Add Expense</a>
                    <div id="msg"></div>
                </form>
            </div>
        </div>

        
        <div class="expense-history-div">
            <h1 class="expense-history-title">Expense History</h1>
            <div class="expense-history-list" id="expensehistory"></div>
        </div>
    </div>
</div>

<script src="../js/jquery.js"></script>
<script src="../js/small_business_expenses_ajax.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
