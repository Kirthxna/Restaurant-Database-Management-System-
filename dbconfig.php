<?php

$host = "localhost";
$username = "id20664319_root";
$password = "Admin@123456";
$dbname = "id20664319_restaurant";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
