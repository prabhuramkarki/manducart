<?php
session_start();
include("db_connection.php");

$page = "customerdashboard.php";
if (!isset($_SESSION['logged_in'])) {
    header("location: login.php?page=$page");

} else {

    $customer_id = $_SESSION['customer_id'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- <link rel="stylesheet" href="../../assets/footer.css"> -->
    <link rel="stylesheet" href="../../assets/customerdashboard.css">

</head>

<body>
    <?php include("nav.php") ?>
    
    <div class="dash-wrapper">
        <div class="dash-heading">
            <h2>Welcome to Customer Dashboard</h2>
        </div>
        <div class="dash-container">
            <div class="dash-card">
                <div class="dash-items">
                    <h2>My Orders</h2>
                    <a href="customerorders.php" class="dash-link">See More</a>
                </div>
            </div>
            <div class="dash-card">
                <div class="dash-items">
                    <h2>History</h2>
                    <a href="history.php" class="dash-link">See More</a>
                </div>
            </div>
            <div class="dash-card">
                <div class="dash-items">
                    <h2>Track Orders</h2>
                    <a href="trackorder.php" class="dash-link">See More</a>
                </div>
            </div>
            <div class="dash-card">
                <div class="dash-items">
                    <h2>User Profile</h2>
                    <a href="customeraccount.php" class="dash-link">See More</a>
                </div>
            </div>

        </div>
    </div>

    <?php include("footer.php"); ?>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>