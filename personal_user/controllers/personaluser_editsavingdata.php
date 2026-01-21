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


$result = $mydb->editSavings(
    $conObj,
    "personal_user_savings",
    $mydata['s_id']
);

if ($result->num_rows > 0) {
    $savingData = $result->fetch_assoc();
    echo json_encode($savingData);
} else {
    echo json_encode(['error' => 'Savings not found']);
}

$mydb->CloseCon($conObj);
?>
