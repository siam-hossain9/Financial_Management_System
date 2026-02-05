<?php include "../controllers/small_business_registration_controller.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Small Business Owner</title>
    <link rel="stylesheet" href="../css/registration_style.css">
    
 
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<a href="../../layouts/views/home_view.php" class="logo registration-logo"><span class="logo-img">F</span>inTech</a>
<?php echo '<p class="success-message">'. $registration_success_message .'</p>'; ?>
<?php echo '<p class="unsuccess-message">'. $registration_error_message .'</p>'; ?>

<div class="login-div registration-div" data-aos="fade-up" data-aos-duration="1000">
   
    <div class="left-section" data-aos="fade-left" data-aos-duration="1000">

        <h1 class="login-title">Sign Up</h1>
        <p class="login-subtitle">Welcome to FinTech. A great money management app!</p>
        
        <form action="" method="POST">
            <input placeholder="Enter business owner name" class="login-user-email-input" name="owner-name" type="text">
            <?php echo '<p class="error" for="">'.$business_owner_name_error.'</p>'; ?>

            <input placeholder="Enter business name" class="login-user-email-input" name="registration-business-name" type="text">
            <?php echo '<p class="error" for="">'.$business_name_error.'</p>'; ?>

            <input placeholder="Enter business email" class="login-user-email-input" name="registration-email" type="text">
            <?php echo '<p class="error" for="">'.$business_email_error.'</p>'; ?>

            <input placeholder="Enter password" class="login-user-password-input" name="registration-password" type="password">
            <?php echo '<p class="error" for="">'.$business_pass_error.'</p>'; ?>

            <input placeholder="Enter confirm password" class="login-user-password-input" name="registration-confirm-password" type="password">
            <?php echo '<p class="error" for="">'.$business_confirm_pass_error.'</p>'; ?>

            <input placeholder="Enter BIN number" class="login-user-email-input" name="registration-bin-number" type="text">
            <?php echo '<p class="error" for="">'.$business_bin_num_error.'</p>'; ?>

            <input placeholder="Enter monthly income" class="login-user-email-input" name="registration-monthly-income" type="text">
            <?php echo '<p class="error" for="">'.$business_monthly_income_error.'</p>'; ?>

            <label for="">Select business type</label>
                <select class="business_type" name="business-type" id="">
                    <option selected value=""></option>
                    <option value="food">Food</option>
                    <option value="clothing">Clothing</option>
                    <option value="transport">Transport</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="others">Others</option>
                </select>
                <?php echo '<p class="error" for="">'.$business_type_error.'</p>'; ?>
            <p class="have-account-txt other-login-txt">Already have an account?</p><a href="../../layouts/views/login_view.php" class="">Log in</a>
            <button type="submit" class="login-btn" name="Submit">Sign Up</button>
        </form>
        <p class="other-login-txt">Login with others</p>
        <a href="#" type="submit" class="google-login-option"><i class="google-icon fa-brands fa-google"></i>Login with google</a>
    </div>

  
    <div class="right-section" data-aos="fade-right" data-aos-duration="1000">
        <img class="login-img" src="../assets/sign up.png" alt="login image" srcset="">
    </div>
</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php include("../../layouts/views/footer.php"); ?>
</body>

</html>
