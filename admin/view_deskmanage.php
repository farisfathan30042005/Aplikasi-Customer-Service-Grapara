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

// Get data meja CS
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM desks WHERE id = $id");
while($data = mysqli_fetch_array($result))
{
    $deskNumber = $data['desk_number'];
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
            <a class="nav-link active" id="desk-tab" data-toggle="tab" href="#desks" role="tab" aria-controls="desks" aria-selected="false">Manage Service Desks</a>
        </li>
    </ul>
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="desks" role="tabpanel" aria-labelledby="desk-tab">
            <h3 class="mt-3">View Service Desk Management</h3>
            <!-- Service desk management form -->
            <form id="deskForm" method="POST" action="">
                <div class="form-group">
                    <label for="deskNumber">Desk Number</label>
                    <input type="text" class="form-control" id="deskNumber" name="deskNumber" value="<?php echo $deskNumber?>" placeholder="Masukkan desk number" required disabled>
                </div>
                <a href="admin.php" class="btn btn-success">Back</a>
            </form>
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
