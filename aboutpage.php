<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aboutpage1.css">
    <title>About Us | InArt</title>
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
    <h1>About Us</h1>
    <h2>Sharing Ideas to Another Level</h2>
    <p>At InArt, we believe that art is not just about visuals; it's about emotions, stories, and experiences. We are passionate about connecting artists with art enthusiasts, creating a vibrant community that celebrates creativity in all its forms.</p>
    <p>Our mission is to promote talented artists and provide a platform for them to showcase their work to a global audience. We curate a diverse collection of artworks, ranging from paintings and sculptures to digital art and mixed media, ensuring there's something for every art lover.</p>
    <p>What sets us apart is our commitment to supporting emerging artists alongside established names. We believe in nurturing talent and fostering a culture of appreciation for innovation and artistic expression.</p>
    <p>Whether you're a seasoned collector or new to the art world, The InArt gallery offers a welcoming space to explore, discover, and connect with extraordinary artworks that inspire and captivate.</p>
    <p>Join us in celebrating the power of art to inspire, provoke thought, and ignite imagination. Explore our gallery, and let the journey of artistic discovery begin!</p>
    <h3>InArt Users</h3>
    <p>1300+</p>
            <h4>Meet the Team</h4>
        <div class="team-member">
            <img src="Images/teammember1.jpg" alt="Team Member 1">
            <h2>Lee Chaolan</h2>
            <p>Founder</p>
            <blockquote>"Art is not what you see, but what you make others see." - Lee Chaolan</blockquote>
            <p>"I started InArt with the vision of creating a space where artists can freely express their creativity and connect with a global audience. Our goal is to inspire, provoke thought, and ignite imagination through the power of art."</p>
        </div>
        <div class="team-member">
            <img src="Images/teammember2.jpg" alt="Team Member 2">
            <h2>Nina Williams</h2>
            <p>Art Director</p>
            <blockquote>"Every artist was first an amateur." - Nina Williams</blockquote>
            <p>"At InArt, we celebrate the journey of every artist, from budding talents to seasoned professionals. My role as Art Director is to curate diverse and inspiring collections that resonate with our audience and push the boundaries of artistic expression."</p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Art Gallery. All rights reserved.</p>
    </footer>
</body>
</html>
