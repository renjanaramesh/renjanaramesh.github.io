<?php
// Retrieve the id value from the query parameter
$id = $_GET['id'];

// Check if the form is submitted for updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the updated values from the form
  $newBudget = $_GET['budget'];
  
  $conn = mysqli_connect('localhost', 'root', '', 'expense');
                
                 // Check connection
                 if (!$conn) {
                     die("Connection failed: " . mysqli_connect_error());
                 }
  $sql = "UPDATE categories SET category = '$newBudget' WHERE id = '$id'";
  // Execute the query
  if (mysqli_query($conn, $sql)) {
    // Redirect to the desired page after successful update
    header("Location: expense.php");
    exit();
  } else {
    // Handle the update error, if any
    echo "Error updating record: " . mysqli_error($conn);
  }
} else {
    $conn = mysqli_connect('localhost', 'root', '', 'expense');
                
    // Check connection
    
}
// Close the database connection
mysqli_close($conn);
?>
