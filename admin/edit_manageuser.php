<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grapara";

// Buat koneksi database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data user
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
while($data = mysqli_fetch_array($result))
{
    $username = $data['username'];
    $password = $data['password'];
    $role = $data['role'];
}

// Query ubah data user
if (isset($_POST['updateUser'])) {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET id = '$id', username = '$username', password = '$password', role = '$role' WHERE id = '$id'";
    $conn->query($sql);
    if($conn){
		echo"<script> alert('Data berhasil diubah'); document.location='admin.php'</script>";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Grapara</title>
    <link rel="icon" type="image/x-icon" href="../images/cs_logo.png">
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
    </ul>
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="user-tab">
            <h3 class="mt-3">Edit User Management</h3>
            <!-- User management form -->
            <form id="userForm" method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username?>" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password?>" placeholder="Masukkan password" required>
                    <input type="checkbox" onclick="showHidePwd()"> Show Password
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">--Silahkan Pilih User Role--</option>
                        <option <?php if($role=='CS'){echo 'selected';} ?> value="CS">CS</option>
                        <option <?php if($role=='Manager'){echo 'selected';} ?> value="Manager">Manager</option>
                    </select>
                </div>
                <a href="admin.php" class="btn btn-success">Back</a>
                <button type="submit" class="btn btn-primary" name="updateUser">Edit User</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showHidePwd() {
      var x = document.getElementById("password");
        if (x.type != "password") {
            x.type = "password";
        } else {
            x.type = "text";
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
