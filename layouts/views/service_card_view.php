<?php include "../controllers/service_card_controller_layout.php"; ?>
<<<<<<< HEAD
<link rel="stylesheet" href="../css/service_card_style.css">

<body>
    <?php 
        if ($allServiceResult->num_rows > 0){
            {
                foreach($allServiceResult as $rows){
                    $signupLink = '';
                    $userType = strtolower(trim((string)($rows['user_type'] ?? '')));
                    if ($userType !== '' && (str_contains($userType, 'personal') || $userType === 'personal user')) {
                        $signupLink = '../../personal_user/views/registration_personaluser.php';
                    } elseif ($userType !== '' && (str_contains($userType, 'business') || str_contains($userType, 'small'))) {
                        $signupLink = '../../small_business_owner/views/registration_small_business_view.php';
                    }
                    
                    echo "<div class='service-card' data-aos='fade-right' data-aos-duration='1000'>";
                       echo '<h1 class="card-title">'. htmlspecialchars($rows['user_type']).'</h1>';
                        echo '<h2 class="card-subtitle">only</h2>';
                        echo '<p class="money">$'. htmlspecialchars($rows['money']) . '<br> per user/month</p>';
                        echo '<a class="sign-up-btn" href="'. ($signupLink !== '' ? $signupLink : '#') .'">Sign Up</a>';
=======
<link rel="stylesheet" href="../css/services_view.css">

<body>
    <?php 
        $count = 0;
        if ($allServiceResult->num_rows > 0){
            {
                foreach($allServiceResult as $rows){
                    echo "<div class='service-card' data-aos='fade-right' data-aos-duration='1000'>";
                       echo '<h1 class="card-title">'. $rows['usertype'].'</h1>';
                        echo '<h2 class="card-subtitle">only</h2>';
                        echo '<p class="money">$'. $rows['money'] . '<br> per user/month</p>';
                        echo '<a class="sign-up-btn" href='. './services_view.php?userTypeId='. $rows['u_id'] .'>Sign Up</a>';
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
                
                        echo '<div class="feature-list">';
                            echo '<li><i class="fa-regular fa-circle-check"></i>100% trustable</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can add expenses</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can add savings</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can see their history</li>';
                        echo '</div>';
                    echo '</div>';
<<<<<<< HEAD
                }
            }
        }
    ?>
</body>
=======
                    $count += 1;
                if ($count >= 3){
                    break;
                }
                }
                
            }
        }
    
    ?>
   
    
</body>
>>>>>>> 7568425b5a30e4c60dc54ef09676747b593cc6a8
