<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include ('../models/small_business_db.php');
$mydb = new Model();


$conn = $mydb->OpenCon();


$B_id = $_SESSION["userid"];

$result = $mydb->savingshistory($conn, "small_business_savings", $B_id);

if ($result->num_rows > 0) {
    $data = array();  
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;       
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}
?>
