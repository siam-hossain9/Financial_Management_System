<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include ('../models/small_business_db.php');

$hasError = false;

$data = stripslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);

if (empty($mydata['name']) || empty($mydata['amount']) || empty($mydata['type'])) {
    $hasError = true;
}

if (!$hasError) {
    $mydb = new Model();
    $conObj = $mydb->OpenCon();

    $result = $mydb->addSavings(
        $conObj,
        "small_business_savings",
        $mydata['id'],
        $mydata['name'],
        $mydata['amount'],
        $mydata['type'],
        $mydata['date']          
    );

    if ($result === TRUE) {
        echo "Savings data inserted successfully.";
    } else {
        echo "Data insertion unsuccessful: " . $conObj->error;
    }
} else {
    echo "Please enter all the information";
}
?>
