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

// Fetch service statistics
$service_stats = "SELECT * FROM service_stats";
$service_stats = $conn->query($service_stats);

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

// Fetch customer issues history
$customerHistoryQuery = "SELECT * FROM customer_issues";
$customerHistoryResult = $conn->query($customerHistoryQuery);

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
            <a class="nav-link" id="logout-tab" aria-controls="logout" aria-selected="false" onclick="javascript:return confirm('Apakah Anda yakin ingin logout?');" href="../autentikasi/logout.php">Logout</a>
        </li>
    </ul>

    <h3 class="mt-5">History</h3>
    <ul id="History">
        <?php
        if ($customerHistoryResult && $customerHistoryResult->num_rows > 0) {
            while ($row = $customerHistoryResult->fetch_assoc()) {
                echo "<li>CS ID: " . htmlspecialchars($row["customer_queue_number"]) . " - Start Time: " . htmlspecialchars($row["start_time"]) . " - End Time: " . htmlspecialchars($row["end_time"]) . " - Issue: " . htmlspecialchars($row["issue"]) . " - Solution: " . htmlspecialchars($row["solution"]) . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>
    
    <h3 class="mt-5">Service Statistics</h3>
    <ul id="ServiceStatistics">
        <?php
        // if ($serviceStatsResult && $serviceStatsResult->num_rows > 0) {
        if ($service_stats && $service_stats->num_rows > 0) {
            while ($row = $service_stats->fetch_assoc()) {
                echo "<li>Service: " . htmlspecialchars($row["service_name"]) . " - Total Requests: " . htmlspecialchars($row["total_requests"]) . " - Successful Requests: " . htmlspecialchars($row["successful_requests"]) . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>

    <h3 class="mt-5">CS Performance Report</h3>
    <ul id="csPerformanceReport">
        <?php
        if ($csPerformanceResult && $csPerformanceResult->num_rows > 0) {
            while ($row = $csPerformanceResult->fetch_assoc()) {
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
            while ($row = $weeklyReportResult->fetch_assoc()) {
                echo "<li>CS: " . htmlspecialchars($row["cs_name"]) . " - Performance Score: " . htmlspecialchars($row["performance_score"]) . "</li>";
            }
        } else {
            echo "<li>No data available</li>";
        }
        ?>
    </ul>
    
    <h3 class="mt-5">Service Statistics Per Day</h3>
<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Total Requests</th>
            <th>Total Service Time (minutes)</th>
            <th>Average Service Time per Customer (minutes)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($service_stats && $service_stats->num_rows > 0) {
            while ($row = $service_stats->fetch_assoc()) {
                $averageServiceTime = $row["total_service_time"] / $row["total_requests"];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["total_requests"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["total_service_time"]) . "</td>";
                echo "<td>" . htmlspecialchars($averageServiceTime) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data available</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>