<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="admin.js"></script>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>

    <?php if(isset($_SESSION['username'])): ?>
        <div class="welcome-message">
            <p>Halo! <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        </div>
    <?php endif; ?>

    <button id="adminPageBtn">Admin Page</button>

    <div class="container">
        <div class="sidebar">
            <h2>Manage</h2>
            <button id="manageUsersBtn">Manage Users</button>
            <button id="manageDesksBtn">Manage Service Desks</button>
            <button id="userManagementBtn">User Management</button>
            <button id="logout"><a href="logout.php">Logout</a></button>
        </div>
        <div class="main">
            <div id="manageUsers" style="display: none;">
                <!-- Konten untuk Manage Users -->
            </div>
            <div id="manageDesks" style="display: none;">
                <!-- Konten untuk Manage Service Desks -->
            </div>
            <div id="userManagement" style="display: none;">
                <!-- Konten untuk User Management -->
            </div>
        </div>
    </div>

    <footer class="footer"><p>© 2024 Grapara Customer Service Simulator Kelompok 1. All Rights Reserved.</p></footer>
</body>
</html>
