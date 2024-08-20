<?php
// Database configuration
$servername = "localhost";  // Your database server
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "sharath";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $phone = $email = $fleets = $typetravel = $date = '';
$nameError = $phoneError = $emailError = $fleetsError = $typetravelError = $dateError = '';
$isValid = true;

// Function to sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameError = "Name is required.";
        $isValid = false;
    } else {
        $name = sanitize($_POST["name"]);
    }

    // Validate Phone
    if (empty($_POST["phone"])) {
        $phoneError = "Phone number is required.";
        $isValid = false;
    } else {
        $phone = sanitize($_POST["phone"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailError = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $isValid = false;
    } else {
        $email = sanitize($_POST["email"]);
    }

    // Validate Service
    if (empty($_POST["fleets"])) {
        $fleetsError = "Please select a service.";
        $isValid = false;
    } else {
        $fleets = sanitize($_POST["fleets"]);
    }

    // Validate Type of Travel
    if (empty($_POST["typetravel"])) {
        $typetravelError = "Please select travel type.";
        $isValid = false;
    } else {
        $typetravel = sanitize($_POST["typetravel"]);
    }

    // Validate Date
    if (empty($_POST["date"])) {
        $dateError = "Date is required.";
        $isValid = false;
    } else {
        $date = sanitize($_POST["date"]);
    }

    // If valid, prepare and execute the SQL query
    if ($isValid) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO quotes (name, phone, email, service, type_of_travel, date) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("ssssss", $name, $phone, $email, $fleets, $typetravel, $date);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../html/success.html");  // Redirect to a success page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>