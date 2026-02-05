<?php 

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
