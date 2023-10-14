<?php
session_start();
$host = "localhost"; // Host name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "library"; // Database name

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
