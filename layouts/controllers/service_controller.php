<?php 

<<<<<<< HEAD
if (isset($_GET['userTypeId'])) {
    $user_type_id = $_GET['userTypeId'];
    
    if ($user_type_id == 1){
        header("Location: ../../personal_user/views/registration_personaluser.php");
        exit;
    }
    elseif ($user_type_id == 2){
        header("Location: ../../small_business_owner/views/registration_small_business_view.php");
        exit;
    }
}

?>
=======

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
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
