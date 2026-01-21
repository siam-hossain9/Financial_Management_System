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
$conObj = $mydb->OpenCon();


$result = $mydb->editSavings($conObj, "small_business_savings", $mydata['s_id']);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No data found"]);
}

$mydb->CloseCon($conObj);
?>
