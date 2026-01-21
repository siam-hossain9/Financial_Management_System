<!DOCTYPE html>
<html lang="en">

<<<<<<< HEAD
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>

<body>
<?php include "./header.php"; ?>

<div class="login-div" data-aos="fade-up" data-aos-duration="1000">

   
=======
<title>Log In</title>
<?php include "./header.php"; ?>
<link rel="stylesheet" href="../css/login_view.css">


<div class="login-div" data-aos="fade-up" data-aos-duration="1000">

    <!-- left section  -->
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
    <div class="left-section" data-aos="fade-left" data-aos-duration="1000">
        <h1 class="login-title">Login</h1>
        <p class="login-subtitle">Login with your account</p>
        
<<<<<<< HEAD
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


=======
        <form action="" method="post">
            <input placeholder="Enter email" class="login-user-email-input" name="login-email" type="text">
            <input placeholder="Enter password" class="login-user-password-input" name="login-password" type="text">
            <a href="./forgot_pass_view.php" class="forgot-pass">Forgot password?</a>
            <a href="#" class="login-btn">Log In</a>
        </form>
        <p class="other-login-txt">Login with others</p>
        <a href="#" class="google-login-option"><i class="google-icon fa-brands fa-google"></i>Login with google</a>
    </div>

    <!-- right section -->
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
    <div class="right-section" data-aos="fade-right" data-aos-duration="1000">
        <img class="login-img" src="../assets/login image.png" alt="login image" srcset="">
    </div>
</div>


<<<<<<< HEAD
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php include "./footer.php" ?>
</body>
</html>
=======

<!-- animation on scroll js  -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    <?php include "./footer.php" ?>
</body>
</html>
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
