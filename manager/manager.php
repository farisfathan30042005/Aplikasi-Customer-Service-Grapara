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
  if (!isset($_SESSION['status']))
   {
      header("location:../index.php?pesan=belum_login");
   }

// Fetch service statistics
$serviceStatsQuery = "SELECT * FROM service_stats";
$serviceStatsResult = $conn->query($serviceStatsQuery);

// Fetch CS performance report
$csPerformanceQuery = "SELECT * FROM cs_performance";
$csPerformanceResult = $conn->query($csPerformanceQuery);

// Fetch average performance score
$averagePerformanceQuery = "SELECT AVG(performance_score) as avg_score FROM cs_performance";
$averagePerformanceResult = $conn->query($averagePerformanceQuery);
$averageScoreRow = $averagePerformanceResult->fetch_assoc();
$averageScore = $averageScoreRow['avg_score'];

// Fetch weekly report (CS with performance above average)
$weeklyReportQuery = "SELECT * FROM weekly_report WHERE performance_score > ?";
$weeklyReportStmt = $conn->prepare($weeklyReportQuery);
$weeklyReportStmt->bind_param("d", $averageScore);
$weeklyReportStmt->execute();
$weeklyReportResult = $weeklyReportStmt->get_result();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager - Grapara</title>
    <link rel="icon" type="image/x-icon" href="../images/cs_logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Manager Panel</h2>
    <ul class="nav nav-tabs" id="managerTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="manager-tab" data-toggle="tab" href="#manager" role="tab" aria-controls="manager" aria-selected="true">View Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="logout-tab" aria-controls="logout" aria-selected="false" onclick="javascript:return confirm('Apakah Anda yakin ingin logout?');" href="../autentikasi/logout.php">Logout</></a>
        </li>
    </ul>

    <div id="serviceStats" class="mt-3">
        <h3>Service Statistics</h3>
        <ul>
            <?php
            if ($serviceStatsResult && $serviceStatsResult->num_rows > 0) {
                while($row = $serviceStatsResult->fetch_assoc()) {
                    echo "<li>Service: " . htmlspecialchars($row["service_name"]) . " - Total Requests: " . htmlspecialchars($row["total_requests"]) . " - Successful Requests: " . htmlspecialchars($row["successful_requests"]) . "</li>";
                }
            } else {
                echo "<li>No data available</li>";
            }
            ?>
        </ul>
    </div>
    <h3 class="mt-5">CS Performance Report</h3>
    <ul id="csPerformanceReport">
        <?php
        if ($csPerformanceResult && $csPerformanceResult->num_rows > 0) {
            while($row = $csPerformanceResult->fetch_assoc()) {
                echo "<li>CS: " . htmlspecialchars($row["cs_name"]) . " - Performance Score: " . htmlspecialchars($row["performance_score"]) . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>
    <h3 class="mt-5">Weekly Report</h3>
    <p>CS with performance above average:</p>
    <ul id="weeklyReport">
        <?php
        if ($weeklyReportResult && $weeklyReportResult->num_rows > 0) {
            while($row = $weeklyReportResult->fetch_assoc()) {
                echo "<li>CS: " . htmlspecialchars($row["cs_name"]) . " - Performance Score: " . htmlspecialchars($row["performance_score"]) . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
