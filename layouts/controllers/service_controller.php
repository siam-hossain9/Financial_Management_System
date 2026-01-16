<?php 


$user_type_id = $_GET['userTypeId'];

if ($user_type_id == 1){
    header("Location: ../views/home_view.php");
}
elseif ($user_type_id == 3){
    // header("Location: ../../small_business_owner/views/registration_small_business_view.php");
    header("Location: ../../small_business_owner/views/dashboard_small_business_view.php");
}
elseif($user_type_id == 2){
    header("Location: ../views/about_view.php");
}


?>