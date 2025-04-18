<?php
$servername = "localhost"; // Usually 'localhost' for XAMPP
$username = "root"; // Default username for MySQL in XAMPP
$password = ""; // No password for root by default in XAMPP
$dbname = "myapp"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
