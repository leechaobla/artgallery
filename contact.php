<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>Contact | InArt</title>
</head>
<body>
    <header>
        <h1>InArt</h1>
    </header>
    <nav class="nav main-nav">
        <a href="gallery.php">Gallery</a>
        <a href="aboutpage.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="profile.php">Profile</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php" class="btn">Log Out</a>
        <?php else: ?>
            <a href="login.html" class="btn">Log In</a>
        <?php endif; ?>
    </nav>
    <main>
    <h2>Contact Us</h2>
    <p>We'd love to hear from you! Whether you have a question about the gallery, a specific artwork, or any other inquiry, please don't hesitate to reach out.</p>

    <form id="contact-form" action="submit_contact.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="5" required></textarea>

    <button type="submit">Send Message</button>
</form>

</main>

    <footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
