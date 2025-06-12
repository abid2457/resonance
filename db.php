<?php
// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$user = "root";  // Change this if using another user
$pass = "";
$dbname = "resonance_db";

// Create a new database connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die("Database connection failed. Please try again later."); 
}

// Set character encoding to UTF-8
$conn->set_charset("utf8");

?>
