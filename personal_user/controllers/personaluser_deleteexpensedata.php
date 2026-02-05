<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include ('../models/personaluserdb.php');

$data = file_get_contents("php://input");
$mydata = json_decode($data, true);

$mydb = new Model();

$conObj = $mydb->OpenConn();

$delete_result = $mydb->deleteExpense($conObj, "personal_user_expense", $mydata['ex_id']);

if ($delete_result === TRUE) {
    echo "Expense deleted successfully";
} else {
    echo "Expense deletion unsuccessful";
}
?>
