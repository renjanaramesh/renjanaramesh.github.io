<?php
session_start();
$user_id = $_SESSION["user_id"];
$conn = mysqli_connect("localhost", "root", "", "expense");

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$documentName = '';
                  $documentPath = '';
                  
                  // Check if the form is submitted
                  if ($_SERVER["REQUEST_METHOD"] === "POST") {
                      // Retrieve the form input values
                      $documentName = $_POST['document_name'];
                      $documentFile = $_FILES['document_file'];
                      $des=$_POST['des'];
                  
                      // Validate and process the uploaded file
                      if ($documentFile['error'] === UPLOAD_ERR_OK) {
                          $fileName = $documentFile['name'];
                          $tempFilePath = $documentFile['tmp_name'];
                  
                          // Move the uploaded file to a permanent location
                          $uploadsDir = 'assets/img/';
                          $documentPath = $uploadsDir . $fileName;
                          move_uploaded_file($tempFilePath, $documentPath);
                  
                          // Insert the document information into the "library" table
                          $sql = "INSERT INTO library (document_name, document_path,description,uid) VALUES ('$documentName', '$documentPath','$des','$user_id')";
                          if (mysqli_query($conn, $sql)) {
                              echo "Document added successfully.";
                              // Reset form input values
                              $documentName = '';
                              $documentPath = '';
                          } else {
                              echo "Error: " . mysqli_error($conn);
                          }
                      } else {
                          echo "Error uploading the file.";
                      }
                  }
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

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Expense</h5>
                   
                  </div>
                  <form class="row g-3 needs-validation" method="POST"  action="" enctype="multipart/form-data">
                  <label for="document_name" class="form-label">Document Name:</label>
        <input type="text" id="document_name" name="document_name" class="form-control" value="<?php echo $documentName; ?>" required><br><br>

        <label for="document_file" class="form-label">Document File:</label>
        <input type="file" id="document_file" name="document_file" class="form-control" required><br><br>
                     
                    <div class="col-12">
                    
                      <label for="yourName" class="form-label">Description</label>
                      <input type="textarea" name="des" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Required</div>
                    
                     
                    </div>

                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="button1">Upload</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0"><a href="library.php">Go Back</a></p>
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