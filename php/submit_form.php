<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost'; // Database host
$dbname = 'sharath'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password
// Hjj$P[7pC

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact_form (name, email, phone, message) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssss", $name, $email, $phone , $message);

// Execute statement
if ($stmt->execute()) {
 // Redirect to success page
 header('Location: ../html/success.html');
 exit(); // Make sure to exit to stop further execution
} else {
 // Redirect to error page with error message
 $error_message = urlencode($stmt->error);
 header('Location: ../html/error.html?error=' . $error_message);
 exit(); // Make sure to exit to stop further execution
}
// Close connection
$stmt->close();
$conn->close();
?>