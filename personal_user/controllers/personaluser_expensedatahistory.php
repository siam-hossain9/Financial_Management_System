<?php
session_start();


if (!isset($_SESSION["useremail"])) {
   
    header("Location:../../layouts/views/login_view.php");
    exit();
}
include ('../models/personaluserdb.php');

$mydb = new Model();


$conn = $mydb->OpenConn();


$P_id = $_SESSION["userid"];

$result = $mydb->expensehistory($conn, "personal_user_expense", $P_id);

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
