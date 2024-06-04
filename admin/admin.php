<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grapara";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle add user
if (isset($_POST['addUser'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $sql = "INSERT INTO users (username, role) VALUES ('$username', '$role')";
    $conn->query($sql);
}

// Handle delete user
if (isset($_POST['deleteUser'])) {
    $id = $_POST['userId'];
    $sql = "DELETE FROM users WHERE id = $id";
    $conn->query($sql);
}

// Handle add desk
if (isset($_POST['addDesk'])) {
    $deskNumber = $_POST['deskNumber'];
    $sql = "INSERT INTO desks (desk_number) VALUES ($deskNumber)";
    $conn->query($sql);
}

// Handle delete desk
if (isset($_POST['deleteDesk'])) {
    $id = $_POST['deskId'];
    $sql = "DELETE FROM desks WHERE id = $id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Grapara</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Admin Panel</h2>
    <ul class="nav nav-tabs" id="adminTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="user-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Manage Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="desk-tab" data-toggle="tab" href="#desks" role="tab" aria-controls="desks" aria-selected="false">Manage Service Desks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logout-tab" aria-controls="logout" aria-selected="false" onclick="javascript:return confirm('Apakah Anda yakin ingin logout?');" href="../autentikasi/logout.php">Logout</></a>
        </li>
    </ul>
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="user-tab">
            <h3 class="mt-3">User Management</h3>
            <!-- User management form -->
            <form id="userForm" method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="Admin">Admin</option>
                        <option value="CS">Customer Service</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
            </form>
            <!-- User table -->
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM users");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['role']}</td>
                                <td>
                                    <form method='POST' action='' style='display:inline-block;'>
                                        <input type='hidden' name='userId' value='{$row['id']}'>
                                        <button type='submit' name='deleteUser' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="desks" role="tabpanel" aria-labelledby="desk-tab">
            <h3 class="mt-3">Service Desk Management</h3>
            <!-- Service desk management form -->
            <form id="deskForm" method="POST" action="">
                <div class="form-group">
                    <label for="deskNumber">Desk Number</label>
                    <input type="number" class="form-control" id="deskNumber" name="deskNumber" placeholder="Masukkan desk number" required>
                </div>
                <button type="submit" class="btn btn-primary" name="addDesk">Add Desk</button>
            </form>
            <!-- Desk table -->
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Desk Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM desks");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['desk_number']}</td>
                                <td>
                                    <form method='POST' action='' style='display:inline-block;'>
                                        <input type='hidden' name='deskId' value='{$row['id']}'>
                                        <button type='submit' name='deleteDesk' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
