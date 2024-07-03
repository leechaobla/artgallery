<?php
$servername = "localhost";
$username = "terry"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "artgallery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
