<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password, role FROM users WHERE user_name = ?");
$stmt->bind_param("s", $user_name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password, $role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        if ($role === 'admin') {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $user_name;
            $_SESSION['admin_login_message'] = "Successfully signed in as admin: $user_name.";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $user_name;
            $_SESSION['user_login_message'] = "Successfully signed in as $user_name.";
            header("Location: mainpage.php");
            exit();
        }
    } else {
        $_SESSION['login_message'] = "Invalid username or password.";
        header("Location: login.html");
        exit();
    }
} else {
    $_SESSION['login_message'] = "Invalid username or password.";
    header("Location: login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
