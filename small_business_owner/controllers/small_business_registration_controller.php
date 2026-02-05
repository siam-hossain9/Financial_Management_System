<?php

include "../models/small_business_db.php";

$business_owner_name=$business_name=$business_email=$business_pass=$business_type=$business_bin_num=$business_confirm_pass=$business_monthly_income= '';
$business_owner_name_error=$business_name_error=$business_email_error=$business_pass_error=$business_confirm_pass_error=$business_type_error=$business_bin_num_error=$hasError=$business_monthly_income_error= '';
$registration_success_message=$registration_error_message = '';


if (isset($_REQUEST['Submit'])){
    
    
    if (empty($_REQUEST['owner-name'])){
        $business_owner_name_error = "Please enter business owner name";
        $hasError = 1;
    }elseif(strlen($_REQUEST['owner-name']) < 4){
        $business_owner_name_error = "Owner name should be at least 4 characters long";
        $hasError = 1;
    }
    elseif(preg_match('/[$@&%#]/', $_REQUEST["owner-name"])){
        $business_owner_name_error = "Owner name should not contain any special character";
        $hasError = 1;
    }
    else{
        $business_owner_name = $_REQUEST["owner-name"];
    }

    
    if (empty($_REQUEST['registration-password'])){
        $business_pass_error = "Please enter password";
        $hasError = 1;
    }elseif(strlen($_REQUEST['registration-password']) < 8){
        $business_pass_error = "Password should be at least 8 characters long";
        $hasError = 1;
    }
    elseif(!preg_match('/[A-Z]/', $_REQUEST["registration-password"])){
        $business_pass_error = "Password must contain at least one uppercase letter";
        $hasError = 1;
    }
    elseif(!preg_match('/[$@&%#]/', $_REQUEST["registration-password"])){
        $business_pass_error = "Password must contain at least one special character [$@&%#]";
        $hasError = 1;
    }
    else{
        $business_pass = $_REQUEST["registration-password"];
    }

   
    if (empty($_REQUEST["registration-email"])){
        $business_email_error = "Please enter email";
        $hasError = 1;
    }elseif(!filter_var($_REQUEST["registration-email"], FILTER_VALIDATE_EMAIL)){
        $business_email_error = "Please enter a valid email";
        $hasError = 1;
    }else{
        $business_email = $_REQUEST["registration-email"];
    }

    
    if (empty($_REQUEST['registration-confirm-password'])){
        $business_confirm_pass_error = "Please confirm password";
        $hasError = 1;
    }elseif($_REQUEST["registration-password"] !== $_REQUEST["registration-confirm-password"]){
        $business_confirm_pass_error = "Password does not match";
        $hasError = 1;
    }else{
        $business_confirm_pass = $_REQUEST["registration-confirm-password"];
    }

  
    if (empty($_REQUEST['registration-bin-number'])){
        $business_bin_num_error = "Please enter BIN number";
        $hasError = 1;
    }elseif(!is_numeric($_REQUEST['registration-bin-number'])){
        $business_bin_num_error = "Please enter numeric value only";
        $hasError = 1;
    }elseif(strlen($_REQUEST['registration-bin-number']) != 8){
        $business_bin_num_error = "BIN number must be exactly 8 digits";
        $hasError = 1;
    }else{
        $business_bin_num = $_REQUEST['registration-bin-number'];
    }

    
    if (empty($_REQUEST['registration-monthly-income'])){
        $business_monthly_income_error = "Please enter monthly income";
        $hasError = 1;
    }elseif(!is_numeric($_REQUEST['registration-monthly-income'])){
        $business_monthly_income_error = "Please enter numeric value only";
        $hasError = 1;
    }else{
        $business_monthly_income = $_REQUEST['registration-monthly-income'];
    }

 
    if (empty($_REQUEST['registration-business-name'])){
        $business_name_error = "Please enter business name";
        $hasError = 1;
    }elseif(strlen($_REQUEST['registration-business-name']) < 2){
        $business_name_error = "Business name should be at least 2 characters long";
        $hasError = 1;
    }
    elseif(preg_match('/[$@&%#]/', $_REQUEST["registration-business-name"])){
        $business_name_error = "Business name should not contain any special character";
        $hasError = 1;
    }
    else{
        $business_name = $_REQUEST["registration-business-name"];
    }

    
    if (empty($_REQUEST["business-type"])){
        $business_type_error = "Please select your business type";
        $hasError = 1;
    }else{
        $business_type = $_REQUEST["business-type"];
    }

    
    if ($hasError != 1){
        $mydb = new Model();
        $conObj = $mydb->OpenCon();
        
        
        $hashed_password = password_hash($business_pass, PASSWORD_DEFAULT);
        
       
        $result = $mydb->addUserIntoRegistration($conObj, "user", $business_owner_name, $business_email, $hashed_password, "business");
        
        
        $result2 = $mydb->addUserIntoSmallBusiness($conObj, "small_business", $business_type, $business_name, $business_bin_num, $business_monthly_income, $business_email, $hashed_password, 0.00);

        if ($result2 === TRUE && $result === TRUE){
            $registration_success_message = "Successfully Registered. Please login.";
            header("Location: ../../layouts/views/login_view.php");
            exit();
        }else{
            $registration_error_message = "Registration unsuccessful. Database error occurred.";
        }
    } else {
        $registration_error_message = "Registration unsuccessful. Please fix the errors above.";
    }
}

?>
