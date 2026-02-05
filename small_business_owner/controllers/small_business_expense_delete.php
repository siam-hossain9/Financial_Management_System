<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include ('../models/small_business_db.php');

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);

$mydb = new Model();

$conn = $mydb->OpenCon();

$delete_result = $mydb->deleteExpense($conn, "small_business_expense", $mydata['ex_id']);

if ($delete_result === TRUE) {
    echo "Expense deleted successfully";
} else {
    echo "Expense deletion unsuccessful";
}
?>
