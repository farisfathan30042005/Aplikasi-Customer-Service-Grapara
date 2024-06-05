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

// Cek status login
session_start();
if (!isset($_SESSION['status'])) {
    header("location:../index.php?pesan=belum_login");
}

// Query untuk mengambil nomor antrian yang belum dilayani
$query = "SELECT id, queue_number FROM queue WHERE id NOT IN (SELECT customer_queue_number FROM customer_issues)";
$result = $conn->query($query);

// Jika queue_id dipilih, arahkan ke halaman dengan queue_id tersebut
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['queue_id'])) {
    $queue_id = $_POST['queue_id'];
    header("Location: cs.php?queue_id=" . $queue_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - Grapara</title>
    <link rel="icon" type="image/x-icon" href="../images/cs_logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Customer Service Panel</h2>
    <?php if (!isset($_GET['queue_id'])): ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="queue_id">Pilih Queue ID</label>
                <div>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<button type='submit' class='btn btn-primary m-1' name='queue_id' value='" . $row['id'] . "'>Queue Number: " . $row['queue_number'] . "</button>";
                        }
                    } else {
                        echo "<p>Tidak ada nomor antrian yang belum dilayani.</p>";
                    }
                    ?>
                </div>
            </div>
        </form>
    <?php else: ?>
        <?php
        // Mendapatkan Queue ID dari URL
        $queue_id = $_GET['queue_id'];

        // Query untuk mendapatkan detail antrian berdasarkan queue_id
        $queueQuery = "SELECT queue_number FROM queue WHERE id = $queue_id";
        $queueResult = $conn->query($queueQuery);
        $queueData = $queueResult->fetch_assoc();
        $queue_number = $queueData['queue_number'];
        ?>
        <form id="recordForm" class="mt-3" method="POST" action="">
            <div class="form-group">
                <label for="deskNumber">Your Desk Number</label>
                <input type="number" class="form-control" id="deskNumber" name="deskNumber" placeholder="Masukkan desk number" required>
            </div>
            <div class="form-group">
                <label for="customerQueueNumber">Customer Queue Number</label>
                <input type="text" class="form-control" id="customerQueueNumber" name="customerQueueNumber" value="<?php echo $queue_number; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="issue">Issue</label>
                <textarea class="form-control" id="issue" name="issue" rows="3" placeholder="Masukkan issue" required></textarea>
            </div>
            <div class="form-group">
                <label for="solution">Solution</label>
                <textarea class="form-control" id="solution" name="solution" rows="3" placeholder="Masukkan solution" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="recordIssue">Record</button>
        </form>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recordIssue'])) {
    $deskNumber = $_POST['deskNumber'];
    $issue = $_POST['issue'];
    $solution = $_POST['solution'];
    $queue_id = $_POST['customerQueueNumber']; // Mengambil queue_id dari form input

    // Insert data into customer_issues table
    $stmt = $conn->prepare("INSERT INTO customer_issues (desk_number, customer_queue_number, issue, solution) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $deskNumber, $queue_id, $issue, $solution);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Update status_pelayanan in queue table
    $updateStmt = $conn->prepare("UPDATE queue SET status_pelayanan = 'sudah_dilayani' WHERE id = ?");
    $updateStmt->bind_param("i", $queue_id);
    $updateStmt->execute();

    $stmt->close();
    $updateStmt->close();
    header("Location: cs.php");
    exit();
}

$conn->close();
?>
