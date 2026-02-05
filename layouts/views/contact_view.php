<!DOCTYPE html>
<html lang="en">
<title>Contact Us</title>
<link rel="stylesheet" href="../css/contact_style.css">

<?php include "./header.php" ?>




<h1 class="contact-title" data-aos="fade-up" data-aos-duration="1000">Get In Touch</h1>

<p class="contact-subtitle" data-aos="fade-down" data-aos-duration="1000">Let's make something big together!</p>

<div class="contact-body">

    <div class="left-section" data-aos="fade-left" data-aos-duration="1000">
        <h1 class="left-section-title">Mail Us</h1>
        <p class="left-section-body">
            We're here to help you with all your financial management needs. Whether you have questions about our services, 
            need assistance with your account, or want to learn more about how our platform can help you achieve your financial goals, 
            our dedicated support team is ready to assist you. 
            Feel free to reach out to us via email, phone, or by filling out the contact form, and we'll get back to you as soon as possible!
        </p>
        <p class="phone-number"><i class="contact-icon fa-solid fa-1x fa-phone-volume"></i>01743140058</p>
        <p class="address"><i class="contact-icon fa-solid fa-1x fa-location-dot"></i>Uttara <br> <span>Dhaka, Bangladesh</span></p>
    </div>

    <div class="right-section" data-aos="fade-right" data-aos-duration="1000">
        <p class="contact-form-title">Please fill this form in a decent manner</p>
        
        <form class="contact-form" action="../controllers/contact_controller.php" method="post">
            <input name="contact_user_name" placeholder="Your Name" type="text" class="contact-username" required>
            <input name="contact_user_email" placeholder="Your Email" type="email" class="contact-email" required>
            <input name="contact_user_address" placeholder="Your Address" type="text" class="contact-address">
            <textarea name="contact_user_message" placeholder="Your Message" class="contact-message" required></textarea>
            <button type="submit" class="contact-submit-btn">Send Message</button>
        </form>
    </div>
</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    <?php include "./footer.php" ?>
</body>
</html>
