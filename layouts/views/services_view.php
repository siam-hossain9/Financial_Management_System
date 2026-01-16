
<?php include "../controllers/service_controller.php"; ?>


<!DOCTYPE html>
<html lang="en">
    <title>Our Services</title>
    <?php include "./header.php" ?>
    <link rel="stylesheet" href="../css/services_view.css">

    <h1 class="service-title" data-aos="fade-up" data-aos-duration="1000">Our Services & Pricing</h1>
    <h3 class="service-subtitle" data-aos="fade-down" data-aos-duration="1000">
        Predictable pricing, no surprises, from individual user to business owners
    </h3>

    <div class="service-card-list">
        <?php 
            include "./service_card_view.php";  
         ?>
    </div>



<!-- animation on scroll js  -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    <?php include "./footer.php" ?>
</body>
</html>