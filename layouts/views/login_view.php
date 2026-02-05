<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>

<body>
<?php include "./header.php"; ?>

<div class="login-div" data-aos="fade-up" data-aos-duration="1000">

   
    <div class="left-section" data-aos="fade-left" data-aos-duration="1000">
        <h1 class="login-title">Login</h1>
        <p class="login-subtitle">Login with your account</p>
        
        <form action="../controllers/logincontrol.php" method="post">
            <input placeholder="Enter email" class="login-user-email-input" name="email" type="email" required>
            
            <input placeholder="Enter password" class="login-user-password-input" name="password" type="password" required>
            
            <div class="user-type-container">
                <label for="user-type">Select User Type</label>
                <select class="business_type" name="user-type" id="user-type" required>
                    <option selected value="">Choose account type</option>
                    <option value="1">Personal User</option>
                    <option value="2">Small Business Owner</option>
                </select>
            </div>
            
            <a href="./forgot_pass_view.php" class="forgot-pass">Forgot password?</a>
            
            <button type="submit" class="login-btn">Log In</button>
        </form>
        
    </div>


    <div class="right-section" data-aos="fade-right" data-aos-duration="1000">
        <img class="login-img" src="../assets/login image.png" alt="login image" srcset="">
    </div>
</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php include "./footer.php" ?>
</body>
</html>
