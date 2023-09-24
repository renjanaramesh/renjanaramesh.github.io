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
                    
                    <label for="yourName" class="form-label">Enter your date</label>
                    <input type="date" name="date1" class="form-control" id="date1" required>
                    <div class="invalid-feedback">Please an Amount!</div>
                  
                   
                  </div>

                  <br>
                  <div class="col-12">
                    <button class="btn btn-primary " type="submit" name="button1">Create DayWise Report</button>
                  </div>
                  <br>
                  <button class="btn btn-primary " type="submit" name="b" onclick="window.location.href = 'monthwisebrgraph.php'">Create Monthwise Report</button>
                  <br>
                <br>
                <button class="btn btn-primary " type="submit" name="b" onclick="window.location.href = 'linegraph.php'">Create YearWise Report</button>
    <br>
      </form>
      <?php
    if (isset($_POST['button1']))
    {
$date1=$_POST["date1"];

      $sql = "SELECT * FROM budget WHERE datec='$date1' and uid='$user_id'";
$result1 = mysqli_query($conn, $sql);
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
            
<div id="donutchart"></div>
<br><br>
<a href=https://www.plus2net.com/php_tutorial/chart-database.php></a>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'language');
        data.addColumn('number', 'Nos');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {
                       pieHole: 0.5,
					   'width':600,
                       'height':500,
			   
					   };

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>

    </section>
    
   

  </main><!-- End #main -->
 
              <?php
require "config.php";// Database connection

if($stmt = $connection->query("SELECT category,amount FROM budget where datec='$date1' and uid='$user_id'")){

  echo "No of records : ".$stmt->num_rows."<br>";
$php_data_array = Array(); // create PHP array
  echo "<table>
<tr> <th>Language</th><th>Nos</th></tr>";
while ($row = $stmt->fetch_row()) {
   echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
   $php_data_array[] = $row; // Adding to array
   }
echo "</table>";
}else{
  echo $connection->error;
}
//print_r( $php_data_array);
// You can display the json_encode output here. 
echo json_encode($php_data_array); 

// Transfor PHP array to JavaScript two dimensional array 
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>
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