<?php
session_start();
$adminUsername = "adminz";
$adminPassword = password_hash("adminz", PASSWORD_DEFAULT);
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Protect against SQL injection
    $inputUsername = $conn->real_escape_string($inputUsername);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        $isAdmin = $row['is_admin'];

        // Verify password
        if (password_verify($inputPassword, $storedPassword)) {
            // Password is correct, start session
            $_SESSION['username'] = $inputUsername;
            $_SESSION['is_admin'] = $isAdmin;
            header("Location: admin.html"); // Redirect to the admin page
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service</title>
    <style>
        <?php include 'styles.css'; ?>
    </style>
</head>
<body>
    <header>
        <h1>Grapara Customer Service</h1>
        <h2>Manage your customer service operations efficiently</h2>
    </header>

     <div id="loginPopup" class="login-popup">
        <div class="login-popup-content">
            <h1 class="log1n">Login</h1>
            <span class="close" onclick="closeLoginPopup()">&times;</span>
            <form method="POST" action="">
                <input type="text" placeholder="Username" name="username" id="username" required>
                <input type="password" placeholder="Password" name="password" id="password" required>
                <button type="submit">Login</button>
            </form>
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
        </div>
    </div>

    <div class="carousel-container">
        <div class="carousel-slide">
            <div class="carousel-text">
                <h2>Seamless Experience</h2>
                <p>Enjoy a seamless experience with our customer service simulator.</p>
            </div>
            <div class="carousel-text">
                <h2>Efficient Customer Support</h2>
                <p>We provide efficient customer support to handle all your queries.</p>
            </div>
            <div class="carousel-text">
                <h2>24/7 Availability</h2>
                <p>Our customer service is available 24/7 to assist you.</p>
            </div>
        </div>
    </div>

    <div class="section-container">
        <div class="section">
        <h2>Admin</h2>
        <p>Manage users and service desks</p>
        <button class="nav-button" onclick="showLoginPopup()">Go To Admin Panel</button>
        </div>
        <div class="section">
            <h2>Customer</h2>
            <p>Get your queue number</p>
            <a href="customer.html" class="nav-button" id="customer">Get Queue Number</a>
        </div>
        <div class="section">
            <h2>Customer Service</h2>
            <p>Log in and manage customer</p>
            <a href="cs.html" class="nav-button">Go to CS Panel</a>
        </div>
       <div class="section">
        <h2>Manager</h2>
        <p>View service statistics and reports</p>
        <button class="nav-button" onclick="showLoginPopup()">Go To Manager Panel</button>
        </div>
    </div>

    <footer class="footer"><p>© 2024 Grapara Customer Service Simulator Kelompok 1. All Rights Reserved.</p></footer>

    <script src="scripts.js"></script>
    <script>
        function closeLoginPopup() {
            document.querySelector('.login-popup').style.display = 'none';
        }
    </script>
</body>
</html>
