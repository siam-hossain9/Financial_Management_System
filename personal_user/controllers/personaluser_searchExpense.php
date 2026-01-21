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


$conn = $mydb->OpenConn();


$P_id = $_SESSION["userid"];

$result = $mydb->searchSavings($conn, "personal_user_savings", $mydata['search'], $P_id);

if ($result->num_rows > 0) {
    $searchData = array();  
    while ($row = $result->fetch_assoc()) {
        $searchData[] = $row;       
    }
    echo json_encode($searchData);
} else {
    echo json_encode([]);
}
?>
