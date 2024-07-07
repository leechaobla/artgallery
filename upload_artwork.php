<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upload.css">
    <title>Upload Artwork | InArt</title>
</head>
<body>
    <header>
        <h1>Upload Artwork</h1>
    </header>
    <nav class="nav main-nav">
        <a href="gallery.php">Gallery</a>
        <a href="aboutpage.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="profile.php">Profile</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="btn">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="btn">Log In</a>
        <?php endif; ?>
    </nav>

    <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Artwork Title" required>
    <textarea name="description" placeholder="Artwork Description" required></textarea>
    <input type="file" name="artwork" accept="image/*" required>
    <label for="privacy">Privacy:</label>
    <select name="privacy" id="privacy" required>
        <option value="public">Public</option>
        <option value="private">Private</option>
    </select>
    <button type="submit">Upload</button>
</form>


    <footer>
        <p>&copy; 2024 InArt Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
