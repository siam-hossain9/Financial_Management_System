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

$delete_result = $mydb->deleteSavings($conObj, "personal_user_savings", $mydata['s_id']);

if ($delete_result === TRUE) {
    echo "Savings deleted successfully";
} else {
    echo "Savings deletion unsuccessful";
}
?>
