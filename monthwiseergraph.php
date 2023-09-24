<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expense";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the session variable
$user_id = $_SESSION["user_id"];

// Retrieve the user details from the database based on the user ID
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

// Check if the user details are found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profile_image = $row["image"];
    $name = $row["name"];
} else {
    // User details not found, handle accordingly
    $profile_image = "apple-touch-icon.png"; // Set a default profile image
    $name = "Unknown"; // Set a default name
}

// Close the database connection




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - FinApp Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

   <script src="assets/vendor/chart.js/chart.umd.js"></script>
 
   <style>
  /* Adjust the size of the chart container */
  #chartContainer {
    width: 400px;
    height: 400px;
    position: relative;
  }
</style>

  <!-- =======================================================
  * Template Name: FinApp
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">FinApp</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/<?php echo $profile_image; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Expenses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="expense.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Expenses Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Income</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="income.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Budget</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="budget.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Tables Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="assets.php">
          <i class="bi bi-house-fill"></i>
          <span>Assets</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="accounts.php">
          <i class="bi bi-credit-card-2-back"></i>
          <span>Accounts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="investments.php">
          <i class="bi bi-currency-exchange"></i>
          <span>Investments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="library.php">
          <i class="bi bi-journals"></i>
          <span>Library</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="complaints.php">
          <i class="bi bi-file-text"></i>
          <span>Complaints</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="experts.php">
          <i class="bi bi-people-fill"></i>
          <span>Experts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="messages.php">
          <i class="bi bi-chat-text"></i>
          <span>Messages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Bills and Subscription</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="BandS.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="BR.php">
              <i class="bi bi-circle"></i><span>Budget</span>
            </a>
          </li>
          <li>
            <a href="ER.php">
              <i class="bi bi-circle"></i><span>Expense</span>
            </a>
          </li>
          <li>
            <a href="IR.php">
              <i class="bi bi-circle"></i><span>Income</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="category.php">
          <i class="bi bi-person"></i>
          <span>Category</span>
        </a>
      </li>

      <li class="nav-heading">---------------------------------------------------------------------</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <form method="POST">
      <div class="col-12">
                    
                    <label for="yourName" class="form-label">Enter your start date</label>
                    <input type="date" name="date1" class="form-control" id="date1" required>
                    <div class="invalid-feedback">Please Enter</div>
                  <br>
                  <label for="yourName" class="form-label">Enter your End date</label>
                    <input type="date" name="date2" class="form-control" id="date2" required>
                    <div class="invalid-feedback">Please Enter!</div>
                   
                  </div>

                  <br>
                  <div class="col-12">
                    <button class="btn btn-primary " type="submit" name="button1">Create Report</button>
                  </div>
                  
    <br>
      </form>
      <?php
    if (isset($_POST['button1']))
    {
$date1=$_POST["date1"];
$date2=$_POST["date2"];

      $sql = "SELECT * FROM expenses WHERE datec BETWEEN '$date1' AND '$date2' AND uid='$user_id'";
$result1 = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM bands WHERE datec BETWEEN '$date1' AND '$date2' AND uid='$user_id'";
$result2 = mysqli_query($conn, $sql2);
?>
<table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                   
                  </tr>
                </thead>
                <tbody>
      <?php 
      $c=1;
      while ($row = mysqli_fetch_assoc($result1)){?>
        <tr>
          <td><?php echo $c; ?></td>
          <td><?php echo $row['category']; ?></td>
          <td><?php echo $row['amount']; ?></td>
        </tr>
      <?php 
     $c=$c+1;
      } ?>

    </tbody>
              </table>  
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                   
                  </tr>
                </thead>
                <tbody>
      <?php 
      $d=1;
      while ($row = mysqli_fetch_assoc($result2)){?>
        <tr>
          <td><?php echo $c; ?></td>
          <td><?php echo $row['category']; ?></td>
          <td><?php echo $row['amount']; ?></td>
        </tr>
      <?php 
     $d=$d+1;
      } ?>
      
    </tbody>
              </table>  
              <?php
              $queryExpenses = "SELECT category, amount FROM expenses WHERE datec BETWEEN '$date1' AND '$date2' AND uid='$user_id'";
              $resultExpenses = mysqli_query($conn, $queryExpenses);
              
              $categoriesArray = array();
              $amountsArray = array();
              
              // Store category and amount values in $categoriesArray and $amountsArray
              if (mysqli_num_rows($resultExpenses) > 0) {
                  while ($rowExpenses = mysqli_fetch_assoc($resultExpenses)) {
                      $category = $rowExpenses['category'];
                      $amount = $rowExpenses['amount'];
                      
                      if (!isset($amountsArray[$category])) {
                          $amountsArray[$category] = 0;
                      }
                      
                      $amountsArray[$category] += $amount;
                      
                      if (!in_array($category, $categoriesArray)) {
                          $categoriesArray[] = $category;
                      }
                  }
              }
              else {
                foreach ($categoriesArray as $category) {
                    $amountsArray[$category] = 0;
                }
              }
              
              // Fetch data from bands table
              $queryBands = "SELECT category, amount FROM bands WHERE datec BETWEEN '$date1' AND '$date2' AND uid='$user_id'";
              $resultBands = mysqli_query($conn, $queryBands);
              
              // Merge the category and amount values into $categoriesArray and $amountsArray
              if (mysqli_num_rows($resultBands) > 0) {
                  while ($rowBands = mysqli_fetch_assoc($resultBands)) {
                      $category = $rowBands['category'];
                      $amount = $rowBands['amount'];
                      
                      if (!isset($amountsArray[$category])) {
                          $amountsArray[$category] = 0;
                      }
                      
                      $amountsArray[$category] += $amount;
                      
                      if (!in_array($category, $categoriesArray)) {
                          $categoriesArray[] = $category;
                      }
                  }
              }
              else {
                foreach ($categoriesArray as $category) {
                    $amountsArray[$category] = $amount;
                }
              }
              
              // Generate random colors for each slice
              $colorsArray = array();
              foreach ($categoriesArray as $category) {
                  $colorsArray[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
              }
              ?>
              <div id="chartContainer">
  <canvas id="myChart"></canvas>
</div>
<br><br>

<script src="assets/vendor/chart.js/chart.umd.js"></script>
   

<script>
  // Get the category and amount data from PHP and store them in JavaScript arrays
  var categories = <?php echo json_encode($categoriesArray); ?>;
  var amounts = <?php echo json_encode($amountsArray); ?>;
  var colors = <?php echo json_encode($colorsArray); ?>;
  
  // Calculate the total amount for each category
  var totalAmounts = categories.map(category => amounts[category]);
  // Create a chart using Chart.js
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'doughnut', // Use 'doughnut' for a donut chart
    data: {
      labels: categories, // Use the categories array as labels
      datasets: [{
        data: totalAmounts, // Use the total amount array as data
        backgroundColor: colors, // Use the colors array for slice backgrounds
        borderColor: colors, // Use the colors array for slice borders
        borderWidth: 1 // Set the border width for all slices
      }]
    },
    options: {
      responsive: true, // Make the chart responsive
      maintainAspectRatio: false, // Disable aspect ratio
      legend: {
        display: true, // Show the legend
        position: 'center', // Set the position of the legend
      },
      plugins: {
        datalabels: {
          display: false, // Hide the data labels
        },
      },
    },
  });
</script>



    </section>
    
   

  </main><!-- End #main -->
 
         

<?php } ?>

  
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>FinApp</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>