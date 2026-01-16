<?php
include '../models/layout_model.php';
session_start();
$email = $password = $emailerror = $passworderror = $hasError = $login_error_message = $usertype = $usertypeerror = '';
if (isset($_REQUEST['Submit'])) {
    if (!empty($_REQUEST["login-email"])) {
        $email = $_REQUEST['login-email'];
    } else {
        $emailerror = 'Enter correct email';
        $hasError = 1;
    }
    if (!empty($_REQUEST["login-password"])) {
        $password = $_REQUEST['login-password'];
    } else {
        $passworderror = 'Enter correct password';
        $hasError = 1;
    }
    if (!empty($_REQUEST["user-type"])) {
        $usertype = $_REQUEST["user-type"];
    } else {
        $usertypeerror = 'Please select user type';
        $hasError = 1;
    }



    if (!$hasError == 1) {
        $mydb = new Model();
        $conobj = $mydb->OpenCon();
        if ($usertype == 'personal') {
            $result = $mydb->PersonalcheckLogin(
                $conobj,
                "personaluser",
                $email,
                $password
            );
        } else {
            $result = $mydb->BusinesscheckLogin(
                $conobj,
                "smallbusinessuser",
                $email,
                $password
            );
        }
        if ($result->num_rows < 1) {
            $login_error_message = "Log in unsuccessful. Please Enter email valid address and password.";
        } else {
            if ($usertype == 'personal') {
                $user = $result->fetch_assoc();
                $_SESSION["userid"] = $user['P_id'];
                $_SESSION["username"] = $user['P_fname'];
                $_SESSION["useremail"] = $email;

                // Set cookies
                setcookie("userid", $user['P_id'], time() + (86400 * 30), "/"); // 30 days
                setcookie("username", $user['P_fname'], time() + (86400 * 30), "/"); // 30 days

                header("Location: ../../personal_user/views/dashboard_personaluser.php");
            } else {

                $user = $result->fetch_assoc();
                $_SESSION["userid"] = $user['B_id'];
                $_SESSION["username"] = $user['Bussiness_name'];
                $_SESSION["useremail"] = $email;

                // Set cookies
                setcookie("userid", $user['B_id'], time() + (86400 * 30), "/"); // 30 days
                setcookie("username", $user['B_name'], time() + (86400 * 30), "/"); // 30 days

                header("Location: ../../small_business_owner/views/dashboard_small_business_view.php");




            }
        }

    }
}



?>