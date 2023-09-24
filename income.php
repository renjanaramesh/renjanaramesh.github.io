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
if (isset($_POST['editSubmit'])) {
  $editId = $_POST['editId'];
  $editAmt = $_POST['editAmt'];
  $editName = $_POST['editName'];
 
  $editamt = $_POST['editamt'];
  $type=$_POST['type'];
  // Update the row in the database
  $sql = "UPDATE income SET category='$editName',amount='$editamt' WHERE id='$editId' and uid='$user_id'";
  $sql1 = "UPDATE accounts SET balance = (balance - $editAmt) + $editamt WHERE id = '$type'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
    mysqli_query($conn, $sql1);
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
if (isset($_POST['editDelete'])) {
  $editId = $_POST['editId'];
 
  

  // Update the row in the database
  $sql = "DELETE FROM income WHERE id='$editId' and uid='$user_id'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
// Retrieve the table data from the database
$sql = "SELECT * FROM income WHERE uid='$user_id'";
$result1 = mysqli_query($conn, $sql);

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
  <style>
    

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
    </style>
    <style>
    .edit-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
    <script>
      function openForm() {
  document.getElementById("myForm").style.display = "block";
}
function openForm1() {
  document.getElementById("myForm1").style.display = "block";
}


function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

    </script>

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
      <h1>Income</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Your Income</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Account Used</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
      <?php 
      $c=1;
      while ($row = mysqli_fetch_assoc($result1)){
        $id=$row['id'];
        $cat=$row['category'];
        $amt1=$row['amount'];
        $acctype=$row['account_type'];
        $query = "SELECT * FROM accounts WHERE name = '$acctype' and uid='$user_id'";
 
        // Executing the query
        $result2 = mysqli_query($conn, $query);
        
        // Checking if the query was successful
        if ($result2) {
            // Fetching the result row
            $row = mysqli_fetch_assoc($result2);
            
            // Storing the ID in another variable
            $acc_id = $row['id'];
            
            // Outputting the expert ID
            
        } else {
            // Error occurred during the query
            echo "Error: " . mysqli_error($conn);
        }?>
        <tr>
        <td><?php echo $c; ?></td>
          <td><?php echo $cat ?></td>
          <td><?php echo $amt1?></td>
          <td><?php echo $acctype ?></td>
          <td>
            <button class="btn btn-primary" onclick="showEditForm(<?php echo $id;?>,<?php echo $amt1;?>,<?php echo $acc_id;?>)">Edit</button>
          </td>
        </tr>
      <?php 
     $c=$c+1;
      } ?>
    </tbody>
              </table>
             
              <button class="btn btn-primary" type="button" id="" onclick="window.location.href = 'newincome.php';" >Add New Income</button>
    </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
   
  </main><!-- End #main -->
  <div id="editForm" class="edit-form">
    <h2>Edit Form</h2>
    <form method="POST" action="">
      <input type="hidden" name="editId" id="editId" >
      
      <input type="hidden" name="editAmt" id="editAmt" >
      <input type="hidden" name="type" id="type" >
      <label for="editName">New Income:</label>
      <br>
      <input type="text" class="form-control" name="editName" id="editName">
      <label for="editName">New Amount:</label>
      <br>
      <input type="number" class="form-control" name="editamt" id="editName">
  
<br>
      <button class="btn btn-primary" type="submit" name="editSubmit">Update</button>
      <br>
      <br>
      <button class="btn btn-primary" type="submit" name="editDelete">Delete</button>
      <br>
      <br>
      <button class="btn btn-primary" type="button" onclick="hideEditForm()">Cancel</button>
    </form>
  </div>

  <script>
    function showEditForm(id,amt1,acc_id) {
      // Retrieve the row data based on the id (e.g., from database)
      var rowData = {
        id: id,
        amt1: amt1,
        acc_id: acc_id,
      };

      // Populate the edit form fields with the row data
      document.getElementById('editId').value = rowData.id;
      document.getElementById('editAmt').value = rowData.amt1;
      document.getElementById('type').value = rowData.acc_id;
      // Show the edit form
      document.getElementById('editForm').style.display = 'block';
    }

    function hideEditForm() {
      // Hide the edit form
      document.getElementById('editForm').style.display = 'none';
    }
  </script>
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