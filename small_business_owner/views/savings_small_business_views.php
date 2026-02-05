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
    <title>My Savings</title>
    <link rel="stylesheet" href="../css/savings_style.css?v=46">
</head>

<body>

<?php include "./subheader_small_business_views.php"; ?>

<div class="savings-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="savings-title">My Savings</h1>
    <h4 class="user-name">Welcome, <?php echo isset($_SESSION['business_name']) ? htmlspecialchars($_SESSION['business_name']) : 'Business Owner'; ?></h4>

    <div class="page-content-wrapper">

        <div class="add-savings-div">
            <div class="current-balace-div">
                <h2 class="current-balance-title">CURRENT BALANCE</h2>
                <h3 class="balance-amount">$<?php echo number_format($currentBalance, 2); ?></h3>
            </div>

            <div class="add-savings">
                <h2 class="add-savings-title">Enter your savings</h2>
                <form action="" method="post" class="add-savings-form" id="savings">
                    <div class="getid"><input class="savings-name-input" type="text" id="savings_id" placeholder="Id" disabled></div>
                    <input type="text" class="savings-name-input" id="savings-name" placeholder="Savings name">
                    <input type="text" class="savings-amount-input" id="savings-amount" placeholder="Savings amount">

                    <label for="">Select type</label>
                    <select class="savings-type" id="savings-type">
                        <option selected value=""></option>
                        <option value="technology">Technology</option>
                        <option value="office">Office Space</option>
                        <option value="marketing">Marketing</option>
                        <option value="transport">Transport</option>
                        <option value="others">Others</option>
                    </select>
                    <a class="add-savings-btn" type="submit" id="addsavings" href="#">Add Savings</a>
                    <div id="msg"></div>
                </form>
            </div>
        </div>

       
        <div class="savings-history-div">
            <h1 class="savings-history-title">Savings History</h1>
            <div class="savings-history-list" id="savingshistory"></div>
        </div>

    </div>
        
    </div>
</div>

</body>
</html>

<script src="../js/jquery.js"></script>
<script src="../js/small_business_savings_ajax.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>