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

// Get data meja CS
$deskNo = mysqli_query($conn, "SELECT * FROM desks");

// Get data cs performance
$csName = $_SESSION['username'];
$getCsPerf = "SELECT * FROM cs_performance WHERE cs_name = $csName";
$getCsPerf = $conn->query($getCsPerf);

// Query untuk mengambil nomor antrian yang belum dilayani
$query = "SELECT id, queue_number FROM queue WHERE id NOT IN (SELECT customer_queue_number FROM customer_issues)";
$result = $conn->query($query);

// Jika queue_id dipilih, arahkan ke halaman dengan queue_id tersebut
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['queue_id'])) {
    $queue_id = $_POST['queue_id'];
    // Catat waktu mulai ketika pengaduan dimulai
    $startTime = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO customer_issues (customer_queue_number, start_time) VALUES (?, ?)");
    $stmt->bind_param("is", $queue_id, $startTime);
    $stmt->execute();
    $stmt->close();
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
    <ul class="nav nav-tabs" id="CSTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cs-tab" data-toggle="tab" href="#cs" role="tab" aria-controls="cs" aria-selected="true">Pilih Queue Number</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logout-tab" aria-controls="logout" aria-selected="false" onclick="javascript:return confirm('Apakah Anda yakin ingin logout?');" href="../autentikasi/logout.php">Logout</a>
        </li>
    </ul>
    <?php if (!isset($_GET['queue_id'])): ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="queue_id"></label>
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
                <select class="form-control" id="deskNumber" name="deskNumber" required>
                    <option value="">--Silahkan Pilih Nomor Meja CS Anda--</option>
                    <?php
			            while($data=mysqli_fetch_array($deskNo)){
			                echo "<option value='$data[desk_number]'>$data[desk_number]</option>";
				        }
                    ?>
                </select>
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
    $queue_number = $_POST['customerQueueNumber']; // Mengambil queue_number dari form input
    $endTime = date("Y-m-d H:i:s"); // Mendapatkan waktu saat ini sebagai end_time

    // Update data di customer_issues table
    $stmt = $conn->prepare("UPDATE customer_issues SET desk_number = ?, issue = ?, solution = ?, end_time = ? WHERE customer_queue_number = ?");
    $stmt->bind_param("isssi", $deskNumber, $issue, $solution, $endTime, $queue_number);
    
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Insert data ke dalam customer_history table
    $historyStmt = $conn->prepare("INSERT INTO customer_history (customer_queue_number, desk_number, issue, solution, start_time, end_time) SELECT customer_queue_number, desk_number, issue, solution, start_time, end_time FROM customer_issues WHERE customer_queue_number = ?");
    $historyStmt->bind_param("i", $queue_number);
    $historyStmt->execute();
    $historyStmt->close();

    // Update status_pelayanan in queue table
    $updateStmt = $conn->prepare("UPDATE queue SET status_pelayanan = 'sudah_dilayani' WHERE id = ?");
    $updateStmt->bind_param("i", $queue_id);
    $updateStmt->execute();
    $updateStmt->close();

    // Insert & Update performance_score in cs_performance table
    $performanceScore = +10;
    if ($getCsPerf->num_rows > 0) {
        $updatePfs = $conn->prepare("UPDATE cs_performance SET performance_score = '$performanceScore' WHERE cs_name = '$csName'");
        $updatePfs->execute();
        $updatePfs->close();
    } else {
        $insertPfs = $conn->prepare("INSERT INTO cs_performance (cs_name, performance_score) VALUES (?, ?)");
        $insertPfs->bind_param("si", $csName, $performanceScore);
        $insertPfs->execute();
        $insertPfs->close();
    }

    // var_dump($csName);die;
    $stmt->close();
    header("Location: cs.php");
    exit();
}

$conn->close();
?>