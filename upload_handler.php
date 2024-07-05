<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['artwork'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_name = $_FILES['artwork']['name'];
    $file_tmp = $_FILES['artwork']['tmp_name'];

    // Example path where uploads will be stored
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    // Check if directory exists or create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory with full permissions
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        exit();
    }

    // Check file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit();
    }

    // Attempt to move the uploaded file
    if (move_uploaded_file($file_tmp, $target_file)) {
        // File uploaded successfully, now insert into database
        // Replace with your database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "artgallery";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind parameters
        $user_id = $_SESSION['user_id'];
        $uploaded_at = date("Y-m-d H:i:s"); // Current datetime
        $sql = "INSERT INTO artworks (user_id, title, description, file_path, uploaded_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $title, $description, $target_file, $uploaded_at);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Artwork uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
?>
