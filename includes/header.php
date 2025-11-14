<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Planner</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to the combined CSS -->
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="assets/images/logo.png" alt="Wedding Planner Logo" class="logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                 <li><a href="packages.php">Packages</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact_client.php">Contact</a></li>
                <li><a href="book_now.php">Book a Consultation</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="login.php">Login</a></li> 
                <?php else: ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
