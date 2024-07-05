<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database.php';

// Query to retrieve user details
$user_id = $_SESSION['user_id'];
$user_sql = "SELECT user_name, email FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);

// Fetch user details
$user_details = $user_result->fetch_assoc();

// Query to retrieve artworks uploaded by the current user
$artworks_sql = "SELECT id, title, description, file_path, uploaded_at FROM artworks WHERE user_id = $user_id";
$artworks_result = $conn->query($artworks_sql);

// Fetch artworks if they exist
$artworks = [];
if ($artworks_result->num_rows > 0) {
    while ($row = $artworks_result->fetch_assoc()) {
        $artworks[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>Profile | InArt</title>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    </header>
    <nav class="nav main-nav">
        <a href="gallery.php">Gallery</a>
        <a href="aboutpage.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php" class="btn">Log Out</a>
    </nav>

    <main>
        <section class="user-details">
            <h2>User Details</h2>
            <p><strong>Username:</strong> <?php echo $user_details['user_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user_details['email']; ?></p>
        </section>

        <h2>Your Uploaded Artworks</h2>
        <?php if (!empty($artworks)): ?>
            <div class="gallery">
                <?php foreach ($artworks as $artwork): ?>
                    <div class="artwork-item">
                        <img src="<?php echo $artwork['file_path']; ?>" alt="<?php echo $artwork['title']; ?>">
                        <h3><?php echo $artwork['title']; ?></h3>
                        <p><?php echo $artwork['description']; ?></p>
                        <p>Uploaded at: <?php echo $artwork['uploaded_at']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>You have not uploaded any artworks yet.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
