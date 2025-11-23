<?php
require_once __DIR__ . '/config.php';

// Create connection using centralized config
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: uncomment for debugging connection success
// echo "Database connected successfully!";
?>
