<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="artgalleryphp.css">
    <title>Gallery | InArt</title>
</head>
<body>
    <header>
        <h1>InArt</h1>
    </header>
    <nav class="nav main-nav">
        <a href="mainpage.php">Home</a>
        <a href="gallery.php">Gallery</a>
        <a href="aboutpage.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="profile.php">Profile</a>
         <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php" class="btn">Log Out</a>
        <?php else: ?>
            <a href="login.php" class="btn">Log In</a>
        <?php endif; ?>
    </nav>

    <main>
        <section class="upload-section">
            <button onclick="window.location.href='upload_artwork.php'">Upload Your Artwork</button>
        </section>

        <h2 class="gallery-header">Gallery</h2>
        <div class="gallery">
            <?php
            // Connect to the database
            include 'database.php';
            
            $sql = "SELECT a.id, a.title, a.description, a.file_path, a.uploaded_at, u.user_name 
            FROM artworks a 
            INNER JOIN users u ON a.user_id = u.id
            WHERE a.privacy = 'public'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="artwork-item" data-id="' . $row['id'] . '" data-title="' . $row['title'] . '" data-description="' . $row['description'] . '" data-file="' . $row['file_path'] . '" data-user="' . $row['user_name'] . '">';
                    echo '<img src="' . $row['file_path'] . '" alt="' . $row['title'] . '">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Uploaded by: ' . $row['user_name'] . '</p>'; // Display user_name instead of user_id
                    echo '</div>';
                }
            } else {
                echo "No artworks found.";
            }

            mysqli_close($conn);
            ?>
        </div>
    </main>

    <div id="artworkModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="">
            <h3 id="modalTitle"></h3>
            <p id="modalDescription"></p>
            <p id="modalUser"></p>
            <div class="comments-section">
                <h4>Comments</h4>
                <div id="comments"></div>
                <textarea id="commentText" placeholder="Leave a comment..."></textarea>
                <button id="submitComment">Submit</button>
            </div>
        </div>
    </div>
    

    <footer>
        <p>&copy; 2024 InArt Art Gallery. All rights reserved.</p>
    </footer>
    
    <script src="artgallery.js"></script>
</body>
</html>
