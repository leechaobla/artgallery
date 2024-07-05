<?php
session_start();
require_once('database.php'); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $privacy = $_POST['privacy'];
    $user_id = $_SESSION['user_id'];

    // File handling
    $file_name = $_FILES['artwork']['name'];
    $file_tmp = $_FILES['artwork']['tmp_name'];
    $file_destination = 'uploads/' . $file_name; 

    if (move_uploaded_file($file_tmp, $file_destination)) {
        // File uploaded successfully, insert into database
        $sql = "INSERT INTO artworks (user_id, title, description, file_path, privacy)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $title, $description, $file_destination, $privacy);

        if ($stmt->execute()) {
            // Redirect or display success message
            header("Location: gallery.php");
            exit();
        } else {
            // Handle database error
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
        // Handle file upload error
        echo "File upload failed.";
    }
}

$conn->close();
?>
