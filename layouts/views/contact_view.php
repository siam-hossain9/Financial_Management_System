<!DOCTYPE html>
<html lang="en">
<title>Contact Us</title>

<?php include "./header.php" ?>
<link rel="stylesheet" href="../css/contact_view.css">

<!-- contact us page -->

<!-- contact title and subtitle -->
<h1 class="contact-title" data-aos="fade-up" data-aos-duration="1000">Get In Touch</h1>

<p class="contact-subtitle" data-aos="fade-down" data-aos-duration="1000">
    Let’s build something meaningful together.
</p>

<!-- contact body -->
<div class="contact-body">
    <!-- left section -->
    <div class="left-section" data-aos="fade-left" data-aos-duration="1000">
        <h1 class="left-section-title">Mail Us</h1>
        <p class="left-section-body">
            Have a question, an idea, or need support? We’re here to help.  
            Reach out anytime and our team will get back to you as soon as possible with clear and helpful answers.
            <br><br>
            Whether it’s feedback, a service inquiry, or just a quick hello, we’re always happy to hear from you.
        </p>
        <p class="phone-number">
            <i class="contact-icon fa-solid fa-1x fa-phone-volume"></i>+1-780-2843810
        </p>
        <p class="address">
            <i class="contact-icon fa-solid fa-1x fa-location-dot"></i>
            123 Main Street <br> <span>Anytown, USA</span>
        </p>
    </div>

    <div class="right-section" data-aos="fade-right" data-aos-duration="1000">
        <p class="contact-form-title">
            Please fill out the form below and we’ll get back to you shortly
        </p>
        
        <form class="contact-form" action="" method="post">
            <input name="contact-user-name" placeholder="Your Name" type="text" class="contact-username">
            <input name="contact-user-email" placeholder="Your Email" type="text" class="contact-email">
            <input name="contact-user-address" placeholder="Your Address" type="text" class="contact-address">
            <textarea name="contact-user-message" placeholder="Your Message" class="contact-message"></textarea>
            <button type="submit" class="contact-submit-btn">Send Message</button>
        </form>
    </div>
</div>



<?php include "./footer.php" ?>
</body>
</html>
