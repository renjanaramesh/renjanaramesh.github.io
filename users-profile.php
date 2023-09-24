<?php
session_start();
$user_id = $_SESSION["user_id"];
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


// Retrieve the user details from the database based on the user ID
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

// Check if the user details are found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profile_image = $row["image"];
    $name = $row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
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

  <title>Users / Profile - FinApp Bootstrap Template</title>
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
        /* Add custom styles for the datepicker */
        .ui-datepicker {
            background-color: #fff; /* Set the background color to white */
            border: 1px solid #ccc; /* Add a border */
            border-radius: 5px; /* Add rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a shadow */
        }

        .ui-datepicker-header {
            background-color: #f0f0f0; /* Set the header background color */
            border: 1px solid #ccc; /* Add a border to the header */
            border-radius: 5px 5px 0 0; /* Add rounded corners only to the top */
            color: #333; /* Set the header text color */
        }

        .ui-datepicker-calendar {
            background-color: #fff; /* Set the calendar background color */
        }

        .ui-state-default,
        .ui-widget-content .ui-state-default,
        .ui-widget-header .ui-state-default {
            background: #f0f0f0; /* Set the default state background color */
            border: 1px solid #ccc; /* Add a border to the default state */
            color: #333; /* Set the default state text color */
        }

        .ui-state-hover,
        .ui-widget-content .ui-state-hover,
        .ui-widget-header .ui-state-hover {
            background: #ddd; /* Set the hover state background color */
            border: 1px solid #999; /* Add a border to the hover state */
            color: #333; /* Set the hover state text color */
        }

        .ui-state-active,
        .ui-widget-content .ui-state-active,
        .ui-widget-header .ui-state-active {
            background: #007bff; /* Set the active state background color */
            border: 1px solid #0056b3; /* Add a border to the active state */
            color: #fff; /* Set the active state text color */
        }
    </style>
  <script>
        const datePicker = document.getElementById('datePicker');
        const today = new Date().toISOString().split('T')[0];
        datePicker.min = today;
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
            <a href="budget.php>
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

      
  </aside>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="assets/img/<?php echo $profile_image; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $name; ?></h2>
            
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">File a Complaint</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#message">Send message to Expert</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#appointment">Book an Appointment with an Expert</button>
                </li>
                

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <form method="POST">
                  <h5 class="card-title">Complaint Form</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Write your complaint</div>
                    <textarea name="com" type="text" class="form-control" id="name" ></textarea>
                  </div>

                  <div class="text-center">
                      <button type="submit" name="complaint" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
                  

                </div>
                
                <?php
if (isset($_POST['complaint'])) {
  
  $name = $_POST['com'];
  
  

  // Update the row in the database
  $sql = "INSERT INTO complaint(uid,complaint) VALUES ('$user_id','$name') ";
  if (mysqli_query($conn, $sql)) {
    echo "Successfully Sent";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/<?php echo $profile_image; ?>" alt="Profile">
                        <input type="file" name="image"/>
                       
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value=<?php echo $name; ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value=<?php echo $email; ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="number" class="form-control" id="Phone" value=<?php echo $phone; ?>>
                      </div>
                    </div>

                   
                    <div class="text-center">
                      <button type="submit" name="button1" class="btn btn-primary">Save Changes</button>
                    </div>
                    
                  </form><!-- End Profile Edit Form -->

                </div>
<?php
if (isset($_POST['button1'])) {
  $img=$_POST['image'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  

  // Update the row in the database
  $sql = "UPDATE users SET image='$img',name='$name',email='$email',phone='$phone' WHERE id='$user_id'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
<div class="tab-pane fade profile-edit pt-3" id="message">

<!-- Profile Edit Form -->
<form method="POST">
 

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Select an expert</label>
    <div class="col-md-8 col-lg-9">
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
$query = "SELECT * FROM expert WHERE status='Active'";
$result = mysqli_query($connection, $query);

// Step 4: Generate HTML dropdown list
echo '<select name="category2" class="form-label" style="width: 100%;">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
}
echo '</select>';

// Step 5: Close database connection

?>
                    </div>    
    </div>
  

  <div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Enter your Message</label>
    <div class="col-md-8 col-lg-9">
    <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
    </div>
  </div>

  

 
  <div class="text-center">
    <button type="submit" name="msg" class="btn btn-primary">Save Changes</button>
  </div>
  
</form><!-- End Profile Edit Form -->

</div>
<?php
if (isset($_POST['msg'])) {
  
  $about = $_POST['about'];
 $cat=$_POST['category2'];
 $escapedName = mysqli_real_escape_string($connection, $cat);

 // Query to search for the name in the expert table and retrieve the ID
 $query = "SELECT id FROM expert WHERE name = '$escapedName'";
 
 // Executing the query
 $result = mysqli_query($connection, $query);
 
 // Checking if the query was successful
 if ($result) {
     // Fetching the result row
     $row = mysqli_fetch_assoc($result);
     
     // Storing the ID in another variable
     $expertId = $row['id'];
     
     // Outputting the expert ID
     
 } else {
     // Error occurred during the query
     echo "Error: " . mysqli_error($connection);
 }
 $query1 = "SELECT COUNT(uid) AS count FROM conversation";

 // Executing the query
 $result1 = mysqli_query($connection, $query1);
 
 // Checking if the query was successful
 if ($result1) {
     // Fetching the result row
     $row = mysqli_fetch_assoc($result1);
     
     // Getting the count from the result
     $count = $row['count'];
     
     // Checking if the count is more than 3
     if ($count > 3) {
         $amt=100;
     } else {
        $amt=0;
     }
 } else {
     // Error occurred during the query
     echo "Error: " . mysqli_error($connection);
 }
  // Update the row in the database
  $sql = "INSERT INTO conversation(uid,exid,amount,msg1) VALUES ('$user_id','$expertId','$amt','$about') ";
  if (mysqli_query($conn, $sql)) {
    echo "Message Successfully Sent";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
<div class="tab-pane fade profile-edit pt-3" id="appointment">

                  <!-- Profile Edit Form -->
                  <form method="POST">
                   

                    

                  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Select an expert</label>
    <div class="col-md-8 col-lg-9">
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
$query = "SELECT * FROM expert WHERE status='Active'";
$result = mysqli_query($connection, $query);

// Step 4: Generate HTML dropdown list
echo '<select name="category2" class="form-label" style="width: 100%;">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
}
echo '</select>';

// Step 5: Close database connection

?>
                    </div>    
    </div>

    <div class="row mb-3">
                      <label for="datePicker" class="col-md-4 col-lg-3 col-form-label">Date </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date" type="text" class="ui-datepicker" id="datePicker" >
                      </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            const today = new Date();
            today.setDate(today.getDate() + 1);
            // Initialize the datepicker
            $("#datePicker").datepicker({
                minDate: today, // Disable all previous dates including today
                dateFormat: "yy-mm-dd"
            });
       
        $("#datePicker").on("change", function() {
                const selectedDate = this.value;
                console.log("Selected Date:", selectedDate);

                // Send the selectedDate to the PHP script using AJAX
                $.ajax({
                    type: "POST",
                    url: "save_selected_date.php", // Replace with your PHP script file
                    data: { date: selectedDate },
                    success: function(response) {
                        // Handle the response from the server if needed
                        console.log("Response from server:", response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if needed
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Type</label>
                      <div class="col-md-8 col-lg-9">
                      <select name="cars" id="cars" class="form-label" style="width: 100%;">
      <option value="online" class="form-label">Online Meeting</option>
      <option value="offline" class="form-label">Offline Meeting</option>
      <option value="phone" class="form-label">Phone</option></select>
                    <div class="text-center">
                      <button type="submit" name="appointment" class="btn btn-primary">Save Changes</button>
                    </div>
                    
                  </form><!-- End Profile Edit Form -->

                </div>
                <?php
if (isset($_POST['appointment'])) {
  
  $date = $_POST['date'];
 $cat=$_POST['category2'];
 $cat1=$_POST['cars'];
 $escapedName = mysqli_real_escape_string($connection, $cat);

 // Query to search for the name in the expert table and retrieve the ID
 $query = "SELECT id FROM expert WHERE name = '$escapedName'";
 
 // Executing the query
 $result = mysqli_query($connection, $query);
 
 // Checking if the query was successful
 if ($result) {
     // Fetching the result row
     $row = mysqli_fetch_assoc($result);
     
     // Storing the ID in another variable
     $expertId = $row['id'];
     
     // Outputting the expert ID
     
 } else {
     // Error occurred during the query
     echo "Error: " . mysqli_error($connection);
 }
 
  // Update the row in the database
  $sql = "INSERT INTO appointment(uid,exid,date,type) VALUES ('$user_id','$expertId','$date','$cat1') ";
  if (mysqli_query($conn, $sql)) {
    ?>
    <script>
    alert("Appointment Scheduled Successfully");
    </script><?php
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>
                <div class="tab-pane fade profile-edit pt-3" id="profile-change-password">

<!-- Profile Edit Form -->
<form method="POST">
 

  

<div class="row mb-3">
<label for="fullName" class="col-md-4 col-lg-3 col-form-label">Select an expert</label>
<div class="col-md-8 col-lg-9">
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
$query = "SELECT * FROM expert WHERE status='Active'";
$result = mysqli_query($connection, $query);

// Step 4: Generate HTML dropdown list
echo '<select name="category2" class="form-label" style="width: 100%;">';
while ($row = mysqli_fetch_assoc($result)) {
echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
}
echo '</select>';

// Step 5: Close database connection

?>
  </div>    
</div>

<div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Date </label>
    <div class="col-md-8 col-lg-9">
      <input name="date" type="date" class="form-control" id="Email" >
    </div>
  </div>

  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Type</label>
    <div class="col-md-8 col-lg-9">
    <select name="cars" id="cars" class="form-label" style="width: 100%;">
<option value="online" class="form-label">Online Meeting</option>
<option value="offline" class="form-label">Offline Meeting</option>
<option value="phone" class="form-label">Phone</option></select>
  <div class="text-center">
    <button type="submit" name="appointment" class="btn btn-primary">Save Changes</button>
  </div>
  
</form><!-- End Profile Edit Form -->

</div>
                <?php
if (isset($_POST['button2'])) {
  $pass=$_POST['password'];
  $name = $_POST['newpassword'];
  $email = $_POST['renewpassword'];
  
  if($name==$email)
{
  
  $sql = "UPDATE users SET password='$email' WHERE id='$user_id'";
  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
else
{
  echo "Passwords does not match";
}
}
?>
              </div><!-- End Bordered Tabs -->

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
      Are you a Expert? <a href="expert/login.php">Login</a>
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