<?php

session_start();
include '../models/layout_model.php';

$email = $password = $emailerror = $passworderror = $hasError = $login_error_message = $usertype = $usertypeerror = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    if (!empty($_POST["email"])) {
        $email = trim($_POST['email']);
    } else {
        $emailerror = 'Enter correct email';
        $hasError = 1;
    }
    

    if (!empty($_POST["password"])) {
        $password = $_POST['password'];
    } else {
        $passworderror = 'Enter correct password';
        $hasError = 1;
    }
    

    if (!empty($_POST["user-type"])) {
        $usertype = $_POST["user-type"];
    } else {
        $usertypeerror = 'Please select user type';
        $hasError = 1;
    }

    if ($hasError != 1) {
        $mydb = new Model();
        $conobj = $mydb->OpenCon();
        

        if ($conobj->connect_error) {
            die("Connection failed: " . $conobj->connect_error);
        }
        

        if ($usertype == '1') {
            $user = $mydb->PersonalcheckLogin(
                $conobj,
                "personal_user",
                $email,
                $password
            );
        } else {
            $user = $mydb->BusinesscheckLogin(
                $conobj,
                "small_business",
                $email,
                $password
            );
        }
        

        if ($user === false) {
            $_SESSION['login_error'] = "Invalid email or password. Please try again.";
            header("Location: ../views/login_view.php");
            exit;
        } else {
            
            if ($usertype == '1') {
               
                $_SESSION["userid"] = $user['P_id'];
                $_SESSION["username"] = $user['P_fname'];
                $_SESSION["useremail"] = $email;
                $_SESSION["usertype"] = 'personal';

                
                setcookie("userid", $user['P_id'], time() + (86400 * 30), "/");
                setcookie("username", $user['P_fname'], time() + (86400 * 30), "/");

                header("Location: ../../personal_user/views/dashboard_personaluser.php");
                exit;
                
            } else {
                
                $_SESSION["userid"] = $user['B_id'];
                $_SESSION["username"] = $user['Bussiness_name'];
                $_SESSION["useremail"] = $email;
                $_SESSION["usertype"] = 'business';

                
                setcookie("userid", $user['B_id'], time() + (86400 * 30), "/");
                setcookie("username", $user['Bussiness_name'], time() + (86400 * 30), "/");

                header("Location: ../../small_business_owner/views/dashboard_small_business_view.php");
                exit;
            }
        }
        
        $mydb->CloseCon($conobj);
    } else {
       
        $_SESSION['login_error'] = "Please fill all fields correctly.";
        header("Location: ../views/login_view.php");
        exit;
    }
}
?>
