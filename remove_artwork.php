<?php
session_start();
require_once('database.php'); 


if (!isset($_SESSION['admin_id'])) {
    header("Location: login.html"); 
    exit();
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $artwork_id = $_GET['id'];


    $stmt = $conn->prepare("DELETE FROM artworks WHERE id = ?");
    $stmt->bind_param("i", $artwork_id);

   
    if ($stmt->execute()) {
        $_SESSION['message'] = "Artwork ID $artwork_id has been successfully removed.";
    } else {
        $_SESSION['error'] = "Error occurred while removing artwork.";
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid artwork ID.";
}

$conn->close();


header("Location: admin_dashboard.php");
exit();
?>
