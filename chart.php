<!DOCTYPE html>
<html>
<head>
    <title>Clustered Column Chart</title>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/chart.js"></script>
</head>
<body>
    <canvas id="clusteredColumnChart"></canvas>

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

    // Step 3: Retrieve data from the database
    $query = "SELECT category FROM categories WHERE type='expense'";
    $result = mysqli_query($connection, $query);
    $query1 = "SELECT amount FROM budget";
    $result1 = mysqli_query($connection, $query1);
    $query2 = "SELECT amount FROM budget'";
    $result2 = mysqli_query($connection, $query2);
    // Step 4: Prepare data for the chart
    $categories = [];
    $budgets = [];
    $expenses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['category'];
        
    }
    while ($row1 = mysqli_fetch_assoc($result1)) {
        
        $budgets[] = $row1['amount'];
        $expenses[] = $row1['amount'];
        
    }
    
    // Step 5: Close database connection
    mysqli_close($connection);
    ?>

    <script>
        // Step 6: Create clustered column chart
        var clusteredColumnChart = new Chart(document.getElementById('clusteredColumnChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [
                    {
                        label: 'Budget',
                        data: <?php echo json_encode($budgets); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'Expense',
                        data: <?php echo json_encode($expenses); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.8)'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>