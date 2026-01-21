<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include ('../models/personaluserdb.php');

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);


$mydb = new Model();

$conObj = $mydb->OpenConn();

$result = $mydb->editExpense($conObj, "personal_user_expense", $mydata['ex_id']);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "Expense not found"]);
}
?>
