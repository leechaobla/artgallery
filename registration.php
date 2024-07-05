<?php
$servername = "localhost";
$username = "terry"; 
$password = "";
$dbname = "artgallery"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user_name = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
$user_id = uniqid('user_', true);
$date = date('Y-m-d H:i:s'); 
$role = 'user'; 


if (isset($_POST['admin_registration']) && $_POST['admin_registration'] == 'yes') {
    $role = 'admin';
}


$stmt = $conn->prepare("INSERT INTO users (user_id, user_name, password, date, email, role) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $user_id, $user_name, $password, $date, $email, $role);


if ($stmt->execute()) {
    header("Location: mainpage.html?registration=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
