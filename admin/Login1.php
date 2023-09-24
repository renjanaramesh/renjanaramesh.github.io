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

// Retrieve the username and password from the POST request
$username = $_POST["username"];
$password = $_POST["password"];

// Perform the validation by querying the database
$sql = "SELECT * FROM admin WHERE email = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Prepare the response
$response = array();
if ($result->num_rows > 0) {
    // Get the user ID from the database result
    $row = $result->fetch_assoc();
    $id = $row["id"];

    // Store the user ID in a session variable
    $_SESSION["id"] = $id;

    $response["success"] = true;
    

    // Redirect to index.html
   
    
   
} else {
    $response["success"] = false;
}

// Send the JSON response
header("Content-Type: application/json");
echo json_encode($response);
