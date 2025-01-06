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

// SQL query to fetch data
$sql = "SELECT * FROM tbl_admin";
$result = $conn->query($sql);

// Check if the query was successful and if there are any records
if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results found.";
}

// Close the connection
$conn->close();
?>
