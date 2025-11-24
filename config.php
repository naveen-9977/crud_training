<?php
// Database credentials (default settings for XAMPP)
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "crud_training";

// Create a new connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Stop everything if no connection
}
?>