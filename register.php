<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone=$_POST['phone'];

    // Validate form inputs
    $errors = array();
   

    // Check if any field is empty
    if (empty($username) || empty($password) || empty($email) || empty($name)) {
        $errors[] = 'All fields are required.';
    }

    // Perform additional validations
    // You can add more validations here based on your requirements

    // If there are no errors, proceed with storing the user information
    if (empty($errors)) {
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
        $stmt = "INSERT INTO users(name,username,password,email,phone) VALUES ('$name','$username','$password','$email','$phone')";
        

        if (mysqli_query($conn, $stmt)) {
            header("Location: login.php");
exit;
            $response["su"] = true;
        } else {
            echo 'Error: ' . mysqli_error($conn);

        }

        // Close statement and connection
       
        $conn->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>

