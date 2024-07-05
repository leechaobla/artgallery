<?php
session_start();

$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "artgallery"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $user_name;
        $_SESSION['login_message'] = "Successfully signed in as $user_name.";
        header("Location: mainpage.php");
        exit();
    } else {
        $_SESSION['login_message'] = "Invalid username or password.";
    }
} else {
    $_SESSION['login_message'] = "Invalid username or password.";
}

$stmt->close();
$conn->close();

header("Location: login.html");
exit();
?>
