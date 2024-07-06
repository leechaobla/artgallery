<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mainpage.css">
    <title>InArt</title>
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
    <section aria-label="slideshow">
        <div class="carousell" data-carousell>
            <button class="carousell-button previous" data-carousell-button="previous">&#8656;</button>
            <button class="carousell-button next" data-carousell-button="next">&#8658;</button>
            <ul data-slides>
                <li class="slide">
                    <img src="Images/deer.jpg" alt="Image 1">
                    <div class="slide-overlay">
                        <h2>Deer in the Wild</h2>
                        <button class="slide-button">Learn More</button>
                    </div>
                </li>
                <li class="slide">
                    <img src="Images/aipic.png" alt="Image 2">
                    <div class="slide-overlay">
                        <h2>AI Generated Art</h2>
                        <button class="slide-button">Learn More</button>
                    </div>
                </li>
                <li class="slide">
                    <img src="Images/peakpx.jpg" alt="Image 3">
                    <div class="slide-overlay">
                        <h2>Mountain Peaks</h2>
                        <button class="slide-button">Learn More</button>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <div class="container">
        <h2 class="container-header">Featured Artworks</h2>
        <div id="featured-artwork" class="featured-artwork">
            <div class="artwork-item">
                <img src="Images/waves.jpg" alt="Artwork 1">
                <h3>Title: Waves</h3>
                <p>Artist: Fujmoto Tatsumak</p>
            </div>
            <div class="artwork-item">
                <img src="Images/artwork2.jpg" alt="Artwork 2">
                <h3>Title: Starry Night</h3>
                <p>Artist: Van Gogh</p>
            </div>
            <div class="artwork-item">
                <img src="Images/artwork3.jpg" alt="Artwork 3">
                <h3>Title: Goddess</h3>
                <p>Artist: WLOP</p>
            </div>
            <div class="artwork-item">
                <img src="Images/artwork4.jpg" alt="Artwork 4">
                <h3>Title: Vykke Elden Ring</h3>
                <p>Artist: Joe Satriani/p>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2024 InArt Gallery. All rights reserved.</p>
    </footer>
</body>
</html>