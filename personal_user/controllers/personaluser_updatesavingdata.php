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


$result = $mydb->updateSavings(
    $conObj,
    "personal_user_savings",
    $mydata['s_id'],
    $mydata['name'],
    $mydata['amount'],
    $mydata['type']
);

if ($result === TRUE) {
    echo "Savings updated successfully.";
} else {
    echo "Update failed: " . $conObj->error;
}

$mydb->CloseCon($conObj);
?>
