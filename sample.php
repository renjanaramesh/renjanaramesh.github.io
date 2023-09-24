<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "expense";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$currentMonth = date('m');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$expenseQuery = "SELECT category, SUM(amount) AS total_amount FROM expenses WHERE MONTH(datec) = $currentMonth GROUP BY category ";
$expenseResult = $conn->query($expenseQuery);

$expenseData = array();
while ($row = $expenseResult->fetch_assoc()) {
    $expenseData[$row['category']] = $row['total_amount'];
}


// Retrieve budget data for the current month
$budgetQuery = "SELECT category, amount FROM budget WHERE MONTH(datec) = $currentMonth";
$budgetResult = $conn->query($budgetQuery);

$budgetData = array();
while ($row = $budgetResult->fetch_assoc()) {
    $budgetData[$row['category']] = $row['amount'];
}
$categories = array_unique(array_merge(array_keys($expenseData), array_keys($budgetData)));
$expenseAmounts = [];
$budgetAmounts = [];

foreach ($categories as $category) {
    $expenseAmounts[] = isset($expenseData[$category]) ? $expenseData[$category] : 0;
    $budgetAmounts[] = isset($budgetData[$category]) ? $budgetData[$category] : 0;
}
$categories = array_map('strval', $categories);
?>
<html>
<head>
    <!-- Include necessary scripts for the charting library -->
    <!-- For example, if using Google Charts: -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>
    
</head>
<body>
<canvas id="chartCanvas"></canvas>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  var categories = <?php echo json_encode($categories); ?>;
        var expenseAmounts = <?php echo json_encode($expenseAmounts); ?>;
        var budgetAmounts = <?php echo json_encode($budgetAmounts); ?>;

        // Convert expenseAmounts and budgetAmounts to numbers
        expenseAmounts = expenseAmounts.map(parseFloat);
        budgetAmounts = budgetAmounts.map(parseFloat);

        var ctx = document.getElementById('chartCanvas').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [
                    {
                        label: 'Expense Amount',
                        data: expenseAmounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Budget Amount',
                        data: budgetAmounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>
</body>
</html>