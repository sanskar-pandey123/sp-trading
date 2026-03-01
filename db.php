<?php
// Database connection
// Update credentials if needed
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'disaster_relief';

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
	http_response_code(500);
	die('Database connection failed: ' . htmlspecialchars($mysqli->connect_error));
}
$mysqli->set_charset('utf8mb4');
?>



