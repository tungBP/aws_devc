<?php
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = "tung2411"; // Replace with your MySQL password
$dbname = "PHP-DB"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$conn->close();
?>
