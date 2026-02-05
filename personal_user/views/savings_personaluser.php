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

$conn->close();

include "./subheader_personaluser.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Savings</title>
    <link rel="stylesheet" href="../css/savings_style.css">

</head>

<body>

<div class="savings-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="savings-title">My Savings</h1>
    <h4 class="user-name">Welcome, <?php echo $_SESSION['username']; ?></h4>

    
    <div class="page-content-wrapper">
        
        
        <div class="add-savings-div">
            <div class="current-balace-div">
                <h2 class="current-balance-title">CURRENT BALANCE</h2>
                <h3 class="balance-amount">$<?php echo number_format($currentBalance, 2); ?></h3>
            </div>

            
            <div class="add-savings">
                <h2 class="add-savings-title">Enter your savings</h2>
                <form action="" method="post" class="add-savings-form" id="savings">
                    <input type="hidden" id="savings_id" name="savings_id" value="">
                    
                    <input type="text" class="savings-name-input" id="savings-name" name="savings-name"
                        placeholder="Savings name">
                    
                    <input type="text" class="savings-amount-input" id="savings-amount" name="savings-amount"
                        placeholder="Savings amount">

                    <label for="savings-type">Select type</label>
                    <select class="savings-type" id="savings-type" name="savings-type">
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
            <input type="text" class="savings-name-input" id="search" placeholder="Search by savings name">
            <div class="savings-history-list" id="savingshistory"></div>
        </div>
        
    </div>
    

</div>


<script src="../script/jquery-3.7.1.js"></script>
<script src="../script/personalsavings_ajaxjson.js"></script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>
