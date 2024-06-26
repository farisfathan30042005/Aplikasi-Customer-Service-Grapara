<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grapara";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queue_number = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    // Generate a queue number (simple increment based on the last queue number)
    $result = $conn->query("SELECT queue_number FROM queue ORDER BY id DESC LIMIT 1");
    $last_queue_number = $result->fetch_assoc()['queue_number'] ?? 0;
    $queue_number = $last_queue_number + 1;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO queue (phone, queue_number) VALUES (?, ?)");
    $stmt->bind_param("si", $phone, $queue_number);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - Grapara</title>
    <link rel="icon" type="image/x-icon" href="../images/cs_logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
    <h2>Get Your Queue Number</h2>
    <form id="queueForm" method="post" action="">
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Masukkan phone number"  pattern="[0-9]" minlength="10" maxlength="13" required>
        </div>
        <a href="../index.php" class="btn btn-success">Back to Home</a>
        <button type="submit" class="btn btn-primary">Get Queue Number</button>
    </form>
    <div id="queueNumber" class="mt-3">
        <?php
        if ($queue_number) {
            echo "<p>Your queue number is: <strong>$queue_number</strong></p>";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
