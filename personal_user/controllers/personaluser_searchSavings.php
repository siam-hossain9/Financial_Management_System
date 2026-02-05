<?php
include ('../models/personaluserdb.php');

$mydb = new Model();


$conn = $mydb->OpenConn();

$
$result = $mydb->searchSavings($conn, "savings", $data['search']);

if ($result->num_rows > 0) {
    $data = array();  
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;       
    }
}


echo json_encode($data);