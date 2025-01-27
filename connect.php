<?php
// PHP code goes here to fetch data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_pcu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbase);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
