<?php 

    include "../models/layout_model.php";

    $mydb = new Model();
    $conObj = $mydb->OpenCon();
    $allServiceResult = $mydb->get_user_type($conObj, "user");





?>
