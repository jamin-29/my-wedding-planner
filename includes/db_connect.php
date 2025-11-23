<?php
// Database configuration
$DB_HOST = '127.0.0.1'; // Use 127.0.0.1 instead of localhost
$DB_USER = 'root';       // Your MySQL username
$DB_PASS = '';           // Your MySQL password
$DB_NAME = 'wedding_planner';
$DB_PORT = 3306;         // Default MySQL port

// Create connection
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: set charset
mysqli_set_charset($conn, "utf8mb4");

// Success message (can remove later)
# echo "Connected successfully";
?>
