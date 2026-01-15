<?php include "../controllers/service_card_controller_layout.php"; ?>

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
                
                        echo '<div class="feature-list">';
                            echo '<li><i class="fa-regular fa-circle-check"></i>100% trustable</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can add expenses</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can add savings</li>';
                            echo '<li><i class="fa-regular fa-circle-check"></i>User can see their history</li>';
                        echo '</div>';
                    echo '</div>';
                    $count += 1;
                if ($count >= 3){
                    break;
                }
                }
                
            }
        }
    
    ?>
   
    
</body>