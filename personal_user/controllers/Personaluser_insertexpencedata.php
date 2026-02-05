<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}
include ('../models/personaluserdb.php');

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);


$P_id = $_SESSION["userid"];

$mydb = new Model();
$conObj = $mydb->OpenConn();


if ($conObj->connect_error) {
    die("Connection failed: " . $conObj->connect_error);
}


$result = $mydb->addExpence(
    $conObj,
    "personal_user_expense",
    $P_id,                  
    $mydata['name'],        
    $mydata['amount'],      
    $mydata['type']         
);

if ($result === TRUE) {
    echo "Expense data inserted successfully.";
} else {
    echo "Error: " . $conObj->error;
}

$mydb->CloseCon($conObj);
?>
