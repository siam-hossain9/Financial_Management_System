<?php
session_start();
if (!isset($_SESSION["useremail"])) {
    header("Location:../../layouts/views/login_view.php");
    exit();
}

include '../models/small_business_db.php';

$mydb = new Model();
$conn = $mydb->OpenCon();
$B_id = $_SESSION["userid"];


$sql = "SELECT * FROM small_business WHERE B_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $B_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Settings</title>
    <link rel="stylesheet" href="../css/settings_style.css?v=5">
</head>

<body>

<?php include "./subheader_small_business_views.php"; ?>

<div class="settings-body" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="settings-title">Settings</h1>
    <h4 class="user-name">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h4>

    <div class="account-info-card">
        <h2 class="account-info-title">Account Information</h2>
        
        <div class="info-item">
            <span class="info-label">Email:</span>
            <span class="info-value"><?php echo htmlspecialchars($userData['B_mail']); ?></span>
        </div>

        <div class="info-item">
            <span class="info-label">User ID:</span>
            <span class="info-value"><?php echo htmlspecialchars($B_id); ?></span>
        </div>

        <div class="info-item">
            <span class="info-label">Username:</span>
            <span class="info-value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>

        <div class="info-item">
            <span class="info-label">Account Type:</span>
            <span class="info-value"><?php echo htmlspecialchars($userData['Bussiness_type']); ?></span>
        </div>

        <div class="info-divider"></div>

        <p class="coming-soon-text">Additional settings features coming soon...</p>
    </div>

</div>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
