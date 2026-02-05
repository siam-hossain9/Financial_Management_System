<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}
if (isset($_COOKIE["userid"]) && isset($_COOKIE["username"])) {
    $userid = $_COOKIE["userid"];
    $username = $_COOKIE["username"];
}
include "./subheader_personaluser.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Settings</title>
    <link rel="stylesheet" href="../css/dashboard_style.css">
</head>

<div class="dashboard-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="dashboard-title">Settings</h1>
    <h4 class="user-name">Welcome, <?php echo $_SESSION['username']; ?></h4>

    <div style="padding: 30px; background: white; border-radius: 10px; margin: 20px;">
        <h2 style="margin-bottom: 20px;">Account Information</h2>
        
        <div style="margin-bottom: 15px;">
            <strong>Email:</strong> <?php echo $_SESSION['useremail']; ?>
        </div>
        
        <div style="margin-bottom: 15px;">
            <strong>User ID:</strong> <?php echo $_SESSION['userid']; ?>
        </div>
        
        <div style="margin-bottom: 15px;">
            <strong>Username:</strong> <?php echo $_SESSION['username']; ?>
        </div>
        
        <div style="margin-bottom: 15px;">
            <strong>Account Type:</strong> Personal User
        </div>

        <hr style="margin: 30px 0;">
        
        <p style="color: #666;">Additional settings features coming soon...</p>
    </div>

</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>
