<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "medical_dashboard"; // Updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connection established successfully";
// }
// ?>
