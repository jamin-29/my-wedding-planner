<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT') ?: 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
if (!$conn) die(json_encode(['error'=>'Connection failed: '.mysqli_connect_error()]));
?>
