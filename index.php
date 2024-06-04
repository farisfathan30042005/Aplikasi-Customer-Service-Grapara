<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_panel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grapara Customer Service Simulator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="hero" style="background-color: #2a7dea; font-weight: 600;">
        <h1>Grapara Customer Service Simulator</h1>
        <p>Manage your customer service operations efficiently</p>
        <div id="headerCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h3>Efficient Customer Support</h3>
                    <p>We provide efficient customer support to handle all your queries.</p>
                </div>
                <div class="carousel-item">
                    <h3>24/7 Availability</h3>
                    <p>Our customer service is available 24/7 to assist you.</p>
                </div>
                <div class="carousel-item">
                    <h3>Seamless Experience</h3>
                    <p>Enjoy a seamless experience with our customer service simulator.</p>
                </div>
            </div>
            <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Admin</h5>
                    <p class="card-text">Manage users and service desks</p>
                    <a href="admin.php" class="btn btn-primary">Go to Admin Panel</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text">Get your queue number</p>
                    <a href="customer.php" class="btn btn-primary">Get Queue Number</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Customer Service</h5>
                    <p class="card-text">Log in and manage customer issues</p>
                    <a href="cs.php" class="btn btn-primary">Go to CS Panel</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Manager</h5>
                    <p class="card-text">View service statistics and reports</p>
                    <a href="manager.php" class="btn btn-primary">Go to Manager Panel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Grapara Customer Service Simulator. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#headerCarousel').carousel({
            interval: 3000 // Change this value (in milliseconds) according to your needs
        });
    });
</script>

</body>
</html>
