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

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deskNumber'])) {
    $deskNumber = $_POST['deskNumber'];
    // You can perform additional validation here if needed

    // If the desk number is valid, you can proceed to serve the customer
    // For now, let's assume the desk number is valid and proceed
}

// Handle recording issue
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recordIssue'])) {
    $deskNumber = $_POST['deskNumber'];
    $customerQueueNumber = $_POST['customerQueueNumber'];
    $issue = $_POST['issue'];
    $solution = $_POST['solution'];

    // Insert data into cs_performance table
    $stmt = $conn->prepare("INSERT INTO cs_performance (cs_name, performance_score) VALUES (?, ?)");
    
    // For now, let's assume the CS name is the desk number
    $csName = $deskNumber;
    
    // Performance score calculation logic can be added here if needed
    // For now, let's assume a fixed performance score
    $performanceScore = 10;

    $stmt->bind_param("si", $csName, $performanceScore);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Customer Service - Grapara</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Customer Service Panel</h2>
    <ul class="nav nav-tabs" id="csTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cs-tab" data-toggle="tab" href="#cs" role="tab" aria-controls="cs" aria-selected="true">Manage Customer Service</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logout-tab" aria-controls="logout" aria-selected="false" onclick="javascript:return confirm('Apakah Anda yakin ingin logout?');" href="../autentikasi/logout.php">Logout</></a>
        </li>
    </ul>

    <div style="margin-top: 17px;" class="tab-content" id="csTabContent">
        <div class="tab-pane fade show active" id="cs" role="tabpanel" aria-labelledby="cs-tab">
            <!-- Customer Service management form -->
            <form id="csForm" method="POST" action="">
                <div class="form-group">
                    <label for="deskNumber">Your Desk Number</label>
                    <input type="number" class="form-control" id="deskNumber" name="deskNumber" placeholder="Masukkan desk number" required>
                </div>
            </form>
            <!-- Form to record issue -->
            <form id="recordForm" class="mt-3" method="POST" action="">
                <div class="form-group">
                    <label for="customerQueueNumber">Customer Queue Number</label>
                    <input type="number" class="form-control" id="customerQueueNumber" name="customerQueueNumber" placeholder="Masukkan customer queue number" required>
                </div>
                <div class="form-group">
                    <label for="issue">Issue</label>
                    <textarea class="form-control" id="issue" name="issue" rows="3" placeholder="Masukkan issue" required></textarea>
                </div>
                <div class="form-group">
                    <label for="solution">Solution</label>
                    <textarea class="form-control" id="solution" name="solution" rows="3" placeholder="Masukkan solution" required></textarea>
                </div>
                <!-- Hidden field to store desk number -->
                <input type="hidden" name="deskNumber" id="hiddenDeskNumber">
                <button type="submit" class="btn btn-primary" name="recordIssue">Record</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
