<?php
// We included guidance in the comments as we worked as a group
$host = "localhost"; // database host if it's not on the same server
$username = "root"; //  database username
$password = ""; // database password
$database = "dis_db"; // database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
