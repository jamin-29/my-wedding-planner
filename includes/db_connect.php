<?php
// Database connection settings
$servername = "localhost";
$username = "root";       // Default XAMPP username
$password = "";           // Default XAMPP password is empty
$database = "wedding_planner";  // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: uncomment for debugging connection success
// echo "Database connected successfully!";
?>
