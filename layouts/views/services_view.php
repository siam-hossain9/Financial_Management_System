<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../css/services_style.css">

<?php include "./header.php"; ?>

<h1 class="service-title" data-aos="fade-up" data-aos-duration="1000">Our Services</h1>
<p class="service-subtitle" data-aos="fade-up" data-aos-duration="1000">
    Choose the plan that fits you best.
</p>

<div class="service-card-list">
    <?php
        include "../controllers/service_card_controller_layout.php";

        if ($allServiceResult->num_rows > 0) {
            foreach ($allServiceResult as $rows) {
                $signupLink = '';
                $userType = strtolower(trim((string)($rows['user_type'] ?? '')));

                if ($userType !== '' && (str_contains($userType, 'personal') || $userType === 'personal user')) {
                    $signupLink = '../../personal_user/views/registration_personaluser.php';
                } elseif ($userType !== '' && (str_contains($userType, 'business') || str_contains($userType, 'small'))) {
                    $signupLink = '../../small_business_owner/views/registration_small_business_view.php';
                }

                echo "<div class='service-card' data-aos='fade-right' data-aos-duration='1000'>";
                    echo '<h1 class="card-title">' . htmlspecialchars($rows['user_type']) . '</h1>';
                    echo '<h2 class="card-subtitle">only</h2>';
                    echo '<p class="money">$' . htmlspecialchars($rows['money']) . '<br> per user/month</p>';
                    echo '<a class="sign-up-btn" href="' . ($signupLink !== '' ? $signupLink : '#') . '">Sign Up</a>';

                    echo '<div class="feature-list">';
                        echo '<li><i class="fa-regular fa-circle-check"></i>100% trustable</li>';
                        echo '<li><i class="fa-regular fa-circle-check"></i>User can add expenses</li>';
                        echo '<li><i class="fa-regular fa-circle-check"></i>User can add savings</li>';
                        echo '<li><i class="fa-regular fa-circle-check"></i>User can see their history</li>';
                    echo '</div>';
                echo '</div>';
            }
        }
    ?>
</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php include "./footer.php"; ?>

</body>
</html>
