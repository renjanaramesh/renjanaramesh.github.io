<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $qualification = $_POST['qualification'];
    $resume = $_FILES["resume"];
    $certificates=$_FILES['certificates'];

    // Validate form inputs
    $errors = array();

    // Check if any field is empty
    if (empty($username) || empty($password) || empty($email) || empty($phone)) {
        $errors[] = 'All fields are required.';
    }

    // Perform additional validations
    // You can add more validations here based on your requirements

    // If there are no errors, proceed with storing the user information
   
                  
                      // Validate and process the uploaded file
                      if ($certificates['error'] === UPLOAD_ERR_OK) {
                          
                          // Insert the document information into the "library" table
                          if (empty($errors)) {
                            $fileName1 = $certificates['name'];
                          $tempFilePath1= $certificates['tmp_name'];
                          $fileName2 = $resume['name'];
                          $tempFilePath2= $resume['tmp_name'];
                  
                  
                          // Move the uploaded file to a permanent location
                          $uploadsDir = 'assets/img/';
                          $documentPath1 = $uploadsDir . $fileName1;
                          move_uploaded_file($tempFilePath1, $documentPath1);
                          $documentPath2 = $uploadsDir . $fileName2;
                          move_uploaded_file($tempFilePath2, $documentPath2);
                  
                            // Database connection settings
                            $servername = "localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "expense";
                    
                            // Create connection
                            $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
                    
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                    
                            // Prepare and execute the SQL statement
                            $sql = "INSERT INTO expert (name,email,phone,qualifications,certifications,resume,password) VALUES ('$username','$email','$phone','$qualification','$documentPath1','$documentPath2','$password')";
                          if (mysqli_query($conn, $sql)) {
                             
                              $certificates = '';
                              $resume = '';
                              header("Location: login.php");
                              exit;
                          } else {
                              echo "Error: " . mysqli_error($conn);
                          }
                          
                      } else {
                          echo "Error uploading the file.";
                      }
                    }}
?>

