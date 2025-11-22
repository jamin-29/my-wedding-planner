<?php
// Database connection settings with env overrides for hosted deployments
$servername = getenv('DB_HOST') ?: 'localhost';
$username   = getenv('DB_USER') ?: 'root';      // Default XAMPP username
$password   = getenv('DB_PASS') ?: '';          // Default XAMPP password is empty
$database   = getenv('DB_NAME') ?: 'wedding_planner';
$dbPort     = (int) (getenv('DB_PORT') ?: 3306);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $dbPort);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: uncomment for debugging connection success
// echo "Database connected successfully!";
?>
