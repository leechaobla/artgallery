<?php
$servername = "localhost";
$username = "terry"; // default username for XAMPP
$password = ""; // default password for XAMPP
$dbname = "artgallery"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user_name = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash the password for security
$user_id = uniqid('user_', true); // generate a unique user_id
$date = date('Y-m-d H:i:s'); // get the current date and time

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (user_id, user_name, password, date, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $user_id, $user_name, $password, $date, $email);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
