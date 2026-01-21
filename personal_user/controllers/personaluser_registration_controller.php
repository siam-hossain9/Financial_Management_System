<?php
include ('../models/personaluserdb.php');


$fname = $lname = $email = $password = $gender = $monthly_income = $username = $hasError = $phone='';
$fnameError = $lnameError = $emailError = $genderError = $usernameError = $passwordError = $MincomeError = $checkboxError = $usernameError=  '';
$MNumericincomeError = $Fnameleantherror = $Lnameleantherror = $phoneNumberError = $registration_success_message=$conObj= $registration_error_message='';



if (isset($_REQUEST['Submit'])) {

    
    if (!empty($_REQUEST["fname"])) {
        $fname = $_REQUEST['fname'];
        if (!(strlen($fname) >= 4 && strlen($fname) <= 25)) {
            $Fnameleantherror = 'First name must be between 4 and 25 characters long';
            $hasError = 1;
        }
    } else {
        $fnameError = "Please Enter First name";
        $hasError = 1;
    }

    if (!empty($_REQUEST["lname"])) {
        $lname = $_REQUEST['lname'];
        if (!(strlen($lname) >= 4 && strlen($lname) <= 25)) {
            $Lnameleantherror = 'Last name must be between 4 and 25 characters long';
            $hasError = 1;
        }
    } else {
        $lnameError = "Please Enter Last name";
        $hasError = 1;
    }


    if (!empty($_REQUEST["email"])) {
        $email = $_REQUEST['email'];
        if (!(strlen($email) >= 5 && strpos($email, '@') !== false && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))) {
            $emailError = "Please enter a valid email address (at least 5 characters and containing '@')";
            $hasError = 1;
        }
    } else {
        $emailError = "Email is Required";
        $hasError = 1;
    }



  
    if (!empty($_REQUEST["username"])) {
        $username = $_REQUEST['username'];
    } else {
        $usernameError = "Please Enter User Name";
        $hasError = 1;
    }

    if (strlen($_REQUEST['password']) < 8 || !preg_match("/[a-z]/", $_REQUEST['password'])) {
        $passwordError = "Password must be at least 8 characters and contain at least one lowercase character";
        $hasError = 1;
    } else {
        $password = $_REQUEST['password'];
    }


    if (empty($_REQUEST['gender'])) {
        $genderError = "Please Select Gender";
        $hasError = 1;
    } else {
        $gender = $_REQUEST['gender'];
    }

    if (!empty($_REQUEST["monthly_income"])) {
        $monthly_income = $_REQUEST['monthly_income'];
        if (!is_numeric($monthly_income)) {
            $MNumericincomeError = "Please Enter Numeric Value";
            $hasError = 1;
        }
    } else {
        $MincomeError = "Please enter your monthly income";
        $hasError = 1;
    }



    if (!$hasError == 1){
        $mydb = new Model();
        $conn = $mydb->OpenConn();
        
   
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
     
        $result2 = $mydb->AddIntoPesonalUser($conn, "personal_user", $fname, $lname, $email, $username, $hashed_password, $gender, $monthly_income);
        
  
        $result = $mydb->addUserIntoRegistration($conn, "user", $username, $email, $hashed_password, "personal");
        
        if ($result2 === TRUE && $result === TRUE){
            $registration_success_message = "Successfully Registered. Please login.";
            header("Location: ../../layouts/views/login_view.php");
            exit();
        } else {
            $registration_error_message = "Registration unsuccessful. Please try again with proper information.";
        }
    } else {
        $registration_error_message = "Registration unsuccessful. Please try again with proper information.";
    }
}

?>
