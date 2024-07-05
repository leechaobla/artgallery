<?php
session_start();
require_once('database.php'); 


if (!isset($_SESSION['admin_id'])) {
    header("Location: login.html"); 
    exit();
}


$sqlArtworks = "SELECT a.id, a.title, a.description, a.file_path, a.uploaded_at, u.user_name 
                FROM artworks a 
                INNER JOIN users u ON a.user_id = u.id";
$resultArtworks = $conn->query($sqlArtworks);


$sqlMessages = "SELECT id, name, email, message, created_at FROM contacts";
$resultMessages = $conn->query($sqlMessages);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Art Gallery</title>
    <link rel="stylesheet" href="admin_styles.css"> 
</head>
<body>
    <header>
        <h1>Welcome Admin!</h1>
    </header>

  
    <div class="artworks-list">
        <h2>Artworks List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Uploaded By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultArtworks->num_rows > 0): ?>
                    <?php while($row = $resultArtworks->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><a href='remove_artwork.php?id=<?php echo $row['id']; ?>'>Remove</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan='5'>No artworks found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <div class="messages-list">
        <h2>Customer Messages</h2>
        <?php if ($resultMessages->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Received At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $resultMessages->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No customer messages found.</p>
        <?php endif; ?>
    </div>

    <footer>
        <a href="logout.php">Logout</a>
    </footer>
</body>
</html>

<?php

$conn->close();
?>
