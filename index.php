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
              <a class="dropdown-item d-flex align-items-center" href="login.php">
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
     
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

               
                <div class="card-body">
                  <h5 class="card-title">Main Budget <span>| This month</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        
                    <i class="bi bi-currency-dollar"></i>
                    </div>
                  
                    <div class="ps-3">
                    
     
                      <h6><?php 
$sql1 = "SELECT * FROM budget WHERE uid = '$user_id' and category='Main Budget' AND MONTH(datec) = MONTH(CURRENT_DATE())";
$result1 = $conn->query($sql1);

// Check if the user details are found
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $amt= $row1["amount"];
    

                      echo $amt;} ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Expenses <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
$sql2 = "SELECT SUM(amount) AS total_amount FROM expenses WHERE uid = '$user_id' AND MONTH(datec) = MONTH(CURRENT_DATE())";
$result2 = $conn->query($sql2);

// Check if the user details are found
if ($result2 && $result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $amt= $row2["total_amount"];
    

                      echo $amt;} ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Bills/Subscriptions <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
$sql2 = "SELECT SUM(amount) AS total_amount FROM bands WHERE uid = '$user_id' AND MONTH(datec) = MONTH(CURRENT_DATE())";
$result2 = $conn->query($sql2);

// Check if the user details are found
if ($result2 && $result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $amt= $row2["total_amount"];
    

                      echo $amt;} ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div>
           
    </section>
 
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h6 class="card-title">NOTIFICATIONS</h6>
              <br>
         
              
              <?php
            $dueDateQuery = "SELECT category,amount, due_date FROM bands WHERE due_date = DATE_SUB(CURDATE(), INTERVAL -1 DAY)";

            // Execute the query
            $result = $conn->query($dueDateQuery);
            
            // Check if there are any bills due in 3 days
            if ($result->num_rows > 0) {
                // Loop through each bill
                while ($row = $result->fetch_assoc()) {
                  echo "<br>";
                  $category=$row['category'];
                    $billAmount = $row['amount'];
                    $dueDate = $row['due_date'];
            
                    // Generate the notification message
                    $notificationMessage = "Your $category is due tomorrow! \n";
                  
                    $notificationMessage1 = "Amount: $billAmount \n";
                    $notificationMessage2 = "Due Date: $dueDate \n";
            
           
                    echo "<h5>".$notificationMessage."</h5>";
                    echo "<h5>".$notificationMessage1."</h5>";
                    echo "<h5>".$notificationMessage2."</h5>";
                }
            } 
            elseif ($result->num_rows == 0)
            {
              $dueDateQuery1 = "SELECT category,amount, due_date FROM bands WHERE due_date = CURDATE()";
              $result1 = $conn->query($dueDateQuery1);
            
              // Check if there are any bills due in 3 days
              
                  // Loop through each bill
                  while ($row1 = $result1->fetch_assoc()) {
                    echo "<br>";
                    $category=$row1['category'];
                      $billAmount = $row1['amount'];
                      $dueDate = $row1['due_date'];
              
                      // Generate the notification message
                      $notificationMessage = "Your $category is due today! \n";
                    
                      $notificationMessage1 = "Amount: $billAmount \n";
                      $notificationMessage2 = "Due Date: $dueDate \n";
              
             
                      echo "<h5>".$notificationMessage."</h5>";
                      echo "<h5>".$notificationMessage1."</h5>";
                      echo "<h5>".$notificationMessage2."</h5>";
                  }
               
            }
            else{
              echo "<h5>No pending bills</h5>";
            }
            $message = "SELECT * FROM conversation WHERE visibility='Unseen' and uid='$user_id' and msg2!='No Message'";
            $mresult = $conn->query($message);
            
            // Check if there are any bills due in 3 days
            if ($mresult->num_rows > 0) {
                // Loop through each bill
                while ($row = $mresult->fetch_assoc()) {
                  echo "<br>";
                  $msg2=$row['msg2'];
                  $id=$row['exid'];
                  $id1=$row['id'];
        $query = "SELECT * FROM expert WHERE id = '$id'";
        $query6 = "UPDATE conversation SET visibility='Seen' WHERE id = '$id1'";
 
 
        // Executing the query
        $result = mysqli_query($conn, $query);
        $result6 = mysqli_query($conn, $query6);
        // Checking if the query was successful
        if ($result) {
            // Fetching the result row
            $row = mysqli_fetch_assoc($result);
            
            // Storing the ID in another variable
            $name = $row['name'];
        
                 
                   
            
                    // Generate the notification message
                    $notificationMessage = "Your have one message from our Expert: $name \n";
                  
                    $notificationMessage1 = "Message:$msg2 \n";
                   
            
           
                    echo "<h5>".$notificationMessage."</h5>";
                    echo "<h5>".$notificationMessage1."</h5>";
                    
        }
                }
            } 
            else
            {
              echo "<h5>No Message from expert</h5>";
            }
            $a = "SELECT * FROM appointment WHERE visibility='Unseen' and uid='$user_id' and msg!='No Message'";
            $aresult = $conn->query($a);
            
            // Check if there are any bills due in 3 days
            if ($aresult->num_rows > 0) {
                // Loop through each bill
                while ($row = $aresult->fetch_assoc()) {
                  echo "<br>";
                  $msg2=$row['msg'];
                  $id=$row['exid'];
                  $id1=$row['id'];
        $query = "SELECT * FROM expert WHERE id = '$id'";
        $query6 = "UPDATE appointment SET visibility='Seen' WHERE id = '$id1'";
 
        // Executing the query
        $result = mysqli_query($conn, $query);
        $result6 = mysqli_query($conn, $query6);
        // Checking if the query was successful
        if ($result) {
            // Fetching the result row
            $row = mysqli_fetch_assoc($result);
            
            // Storing the ID in another variable
            $name = $row['name'];
        
                 
                   
            
                    // Generate the notification message
                    $notificationMessage = "Your have one message from our Expert(regarding appointment): $name \n";
                  
                    $notificationMessage1 = "Message:$msg2 \n";
                   
            
           
                    echo "<h5>".$notificationMessage."</h5>";
                    echo "<h5>".$notificationMessage1."</h5>";
                    
        }
                }
            } 
            else
            {
              echo "<h5>No Message from expert</h5>";
            }
            ?>

            </div>
          </div>

        </div>
      </div>
    </section>
    
  </main><!-- End #main -->

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