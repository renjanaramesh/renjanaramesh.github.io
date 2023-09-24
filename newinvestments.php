<?php
session_start();
$user_id = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - FinApp Bootstrap Template</title>
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">FinApp</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3" style="height: 100%;">

                <div class="card-body" style="height: 100%;">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Investment</h5>
                   
                  </div>
                  <form class="row g-3 needs-validation" method="POST"  action=""  >
                  <div class="col-12">
                    
                    <label for="yourName" class="form-label">Company Name</label>
                    <input type="text" name="name" class="form-control" id="yourName" required>
                    <div class="invalid-feedback">Required</div>
                  
                   
                  </div>
                  <div class="col-12">
                      
                      <label for="yourName" class="form-label">Investment Type</label>

                      <div class="invalid-feedback">Required</div>
                    
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
$query = "SELECT * FROM categories WHERE user_id='$user_id' and type='investments'";
$result = mysqli_query($connection, $query);

// Step 4: Generate HTML dropdown list
echo '<select name="category1" class="form-label" style="width: 100%;">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['category'] . '">' . $row['category'] . '</option>';
}
echo '</select>';

// Step 5: Close database connection
mysqli_close($connection);
?>

</div>                

                    <div class="col-12">
                    
                      <label for="yourName" class="form-label">Amount Invested</label>
                      <input type="number" name="amount" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please an Amount!</div>
                    
                     
                    </div>

                    <div class="col-12">
                      
                      <label for="yourName" class="form-label">Account used</label>

                      <div class="invalid-feedback">Required</div>
                    
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
$query = "SELECT * FROM accounts WHERE uid='$user_id'";
$result = mysqli_query($connection, $query);

// Step 4: Generate HTML dropdown list
echo '<select name="category2" class="form-label" style="width: 100%;">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
}
echo '</select>';

// Step 5: Close database connection
mysqli_close($connection);
?>

</div>   
<div class="col-12">
                    
                      <label for="yourName" class="form-label">Share Number</label>
                      <input type="number" name="num" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Required</div>
                    
                     
                    </div>
                    <div class="col-12">
                    
                      <label for="yourName" class="form-label">Current Price</label>
                      <input type="number" name="cprice" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Required</div>
                    
                     
                    </div>
                    <div class="col-12">
                    
                      <label for="yourName" class="form-label">Price Date</label>
                      <input type="date" name="pricedate" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Required</div>
                    
                     
                    </div>      
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="button1">Create</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0"><a href="investments.php">Go Back</a></p>
                    </div>
                  </form>
                  
                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <?php
                  if (isset($_POST['button1'])) {
  // Retrieve the updated values from the form
  $name=$_POST['name'];
  $type = $_POST['category1'];
  $amt = $_POST['amount'];
  $accounts=$_POST['category2'];
  $num=$_POST['num'];
  $cprice=$_POST['cprice'];
  $pricedate=$_POST['pricedate'] ; 
  $conn = mysqli_connect('localhost', 'root', '', 'expense');
                
                 // Check connection
                 if (!$conn) {
                     die("Connection failed: " . mysqli_connect_error());
                 }
                 $sql = "INSERT INTO investments(company_name,investment_type,amount,account,number,current_price,price_date,uid) VALUES ('$name','$type','$amt','$accounts','$num','$cprice','$pricedate','$user_id')";
                 // Execute the query
                 if (mysqli_query($conn, $sql)) {
                   echo "Created Successfully";
                 } else {
                   // Handle the update error, if any
                   echo "Error updating record: " . mysqli_error($conn);
                 }
         
  
} ?>
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