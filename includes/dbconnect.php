<?php
// Database configuration
$host = "localhost";     // Database host
$username = "root"; // Database username
$password = ""; // Database password
$database = "hannasconnect"; // Database name

$conn = mysqli_connect($host, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




?>
