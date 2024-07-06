<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


include 'database.php';


$user_id = $_SESSION['user_id'];
$user_sql = "SELECT user_name, email FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);


$user_details = $user_result->fetch_assoc();


$artworks_sql = "SELECT id, title, description, file_path, uploaded_at FROM artworks WHERE user_id = $user_id";
$artworks_result = $conn->query($artworks_sql);


$artworks = [];
if ($artworks_result->num_rows > 0) {
    while ($row = $artworks_result->fetch_assoc()) {

        $artwork_id = $row['id'];
        $comments_sql = "SELECT c.comment, u.user_name FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.artwork_id = $artwork_id";
        $comments_result = $conn->query($comments_sql);


        $comments = [];
        if ($comments_result->num_rows > 0) {
            while ($comment_row = $comments_result->fetch_assoc()) {
                $comments[] = $comment_row;
            }
        }


        $row['comments'] = $comments;


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            function loadComments(artworkId) {
                $.ajax({
                    url: 'get_comments.php',
                    type: 'GET',
                    data: { artwork_id: artworkId },
                    dataType: 'json',
                    success: function(data) {
                        
                        var commentsHtml = '';
                        if (data.length > 0) {
                            data.forEach(function(comment) {
                                commentsHtml += '<div class="comment">';
                                commentsHtml += '<p><strong>' + comment.username + ':</strong> ' + comment.comment + '</p>';
                                commentsHtml += '</div>';
                            });
                        } else {
                            commentsHtml = '<p>No comments yet.</p>';
                        }
                        $('#comments-' + artworkId).html(commentsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading comments:', error);
                    }
                });
            }


            $('.artwork-item').on('click', '.toggle-comments', function() {
                var artworkId = $(this).data('artwork-id');
                var commentsContainer = $('#comments-' + artworkId);
                if (commentsContainer.is(':empty')) {
                    loadComments(artworkId);
                }
                commentsContainer.toggle();
            });
        });
    </script>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    </header>
    <nav class="nav main-nav">
        <a href="gallery.php">Gallery</a>
        <a href="aboutpage.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="logout.php" class="btn">Log Out</a>
    </nav>

    <main class="container">
        <section class="user-details">
            <h2>User Details</h2>
            <p><strong>Username:</strong> <?php echo $user_details['user_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user_details['email']; ?></p>
        </section>

        <h2>Your Uploaded Artworks</h2>
        <?php if (!empty($artworks)): ?>
            <?php foreach ($artworks as $artwork): ?>
                <div class="artwork-item">
                    <img src="<?php echo $artwork['file_path']; ?>" alt="<?php echo $artwork['title']; ?>">
                    <h3><?php echo $artwork['title']; ?></h3>
                    <p><?php echo $artwork['description']; ?></p>
                    <p>Uploaded at: <?php echo $artwork['uploaded_at']; ?></p>
                    

                    <button class="toggle-comments" data-artwork-id="<?php echo $artwork['id']; ?>">Toggle Comments</button>
                    

                    <div id="comments-<?php echo $artwork['id']; ?>" style="display: none;"></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You have not uploaded any artworks yet.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 InArt Art Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
