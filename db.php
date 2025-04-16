<?php
$host = "localhost";         // Correct variable name
$user = "root";              // Default XAMPP username
$password = "040301@Shilki1";              // No password in default XAMPP
$dbname = "ecommercedb";     // Your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
