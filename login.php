<?php
session_start(); // Start the session

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
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT id, password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);

// Execute the statement
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Password is correct, start a session
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $user_name;

        // Redirect to a logged-in page (e.g., dashboard.html)
        header("Location: mainpagesigned.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Invalid username or password.";
}

// Close connection
$stmt->close();
$conn->close();
?>
