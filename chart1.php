<!DOCTYPE html>
<html>
<head>
    <title>Donut Chart</title>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/chart.js"></script>
</head>
<body>
    <div style="width: 600px; margin: 0 auto;">
        <canvas id="donutChart"></canvas>
    </div>

    <?php
    // Step 1: Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "expense";

    // Step 2: Establish database connection
    $connection = mysqli_connect($host, $username, $password, $database);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Step 3: Get date range from user (you can modify this based on your requirements)
    $startDate ='2023-06-06';
    $endDate = '2023-06-08';

    // Step 4: Generate day-wise report
    $dayQuery = "SELECT DATE(datec) AS day, SUM(amount) AS total_amount FROM expenses WHERE datec BETWEEN '$startDate' AND '$endDate' GROUP BY day ORDER BY day ASC";
    $dayResult = mysqli_query($connection, $dayQuery);

    // Step 5: Generate month-wise report
    $monthQuery = "SELECT DATE_FORMAT(datec, '%Y-%m') AS month, SUM(amount) AS total_amount FROM expenses WHERE datec BETWEEN '$startDate' AND '$endDate' GROUP BY month ORDER BY month ASC";
    $monthResult = mysqli_query($connection, $monthQuery);

    // Step 6: Generate year-wise report
    $yearQuery = "SELECT YEAR(datec) AS year, SUM(amount) AS total_amount FROM expenses WHERE datec BETWEEN '$startDate' AND '$endDate' GROUP BY year ORDER BY year ASC";
    $yearResult = mysqli_query($connection, $yearQuery);

    // Step 7: Prepare data for donut chart
    $dayLabels = [];
    $dayData = [];
    while ($row = mysqli_fetch_assoc($dayResult)) {
        $dayLabels[] = $row['day'];
        $dayData[] = $row['total_amount'];
    }

    $monthLabels = [];
    $monthData = [];
    while ($row = mysqli_fetch_assoc($monthResult)) {
        $monthLabels[] = $row['month'];
        $monthData[] = $row['total_amount'];
    }

    $yearLabels = [];
    $yearData = [];
    while ($row = mysqli_fetch_assoc($yearResult)) {
        $yearLabels[] = $row['year'];
        $yearData[] = $row['total_amount'];
    }

    // Step 8: Close database connection
    mysqli_close($connection);
    ?>

    <script>
        // Step 9: Create donut chart
        var donutChart = new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($monthLabels); ?>, // Use dayLabels, monthLabels, or yearLabels based on the desired report
                datasets: [{
                    data: <?php echo json_encode($monthData); ?>, // Use dayData, monthData, or yearData based on the desired report
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>