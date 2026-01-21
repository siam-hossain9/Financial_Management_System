<?php
<<<<<<< HEAD

session_start();
include '../models/layout_model.php';

$email = $password = $emailerror = $passworderror = $hasError = $login_error_message = $usertype = $usertypeerror = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    if (!empty($_POST["email"])) {
        $email = trim($_POST['email']);
=======
include '../models/layout_model.php';
session_start();
$email = $password = $emailerror = $passworderror = $hasError = $login_error_message = $usertype = $usertypeerror = '';
if (isset($_REQUEST['Submit'])) {
    if (!empty($_REQUEST["login-email"])) {
        $email = $_REQUEST['login-email'];
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
    } else {
        $emailerror = 'Enter correct email';
        $hasError = 1;
    }
<<<<<<< HEAD
    

    if (!empty($_POST["password"])) {
        $password = $_POST['password'];
=======
    if (!empty($_REQUEST["login-password"])) {
        $password = $_REQUEST['login-password'];
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
    } else {
        $passworderror = 'Enter correct password';
        $hasError = 1;
    }
<<<<<<< HEAD
    

    if (!empty($_POST["user-type"])) {
        $usertype = $_POST["user-type"];
=======
    if (!empty($_REQUEST["user-type"])) {
        $usertype = $_REQUEST["user-type"];
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
    } else {
        $usertypeerror = 'Please select user type';
        $hasError = 1;
    }

<<<<<<< HEAD
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
=======


    if (!$hasError == 1) {
        $mydb = new Model();
        $conobj = $mydb->OpenCon();
        if ($usertype == 'personal') {
            $result = $mydb->PersonalcheckLogin(
                $conobj,
                "personaluser",
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
                $email,
                $password
            );
        } else {
<<<<<<< HEAD
            $user = $mydb->BusinesscheckLogin(
                $conobj,
                "small_business",
=======
            $result = $mydb->BusinesscheckLogin(
                $conobj,
                "smallbusinessuser",
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
                $email,
                $password
            );
        }
<<<<<<< HEAD
        

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
=======
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
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
