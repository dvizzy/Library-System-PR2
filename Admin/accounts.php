<?php
// PHP code goes here to fetch data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "db_pcu";
$conn = new mysqli($servername, $username, $password, $dbase);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_admin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>User Accounts</title>
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color:#020873;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }
        

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
        action-icons {
            display: flex;
            gap: 10px; /* Space between icons */
        }

        .action-icons i {
            cursor: pointer;
            font-size: 20px; /* Icon size */
        }

        .edit-btn {
            color: #4CAF50; /* Green color for Edit */
        }

        .delete-btn {
            color: #f44336; /* Red color for Delete */
        }

        .edit-btn:hover {
            color: #45a049;
        }

        .delete-btn:hover {
            color: #e53935;
        }
    </style>
</head>
<body>

    <h1>Manage Accounts</h1>

    <?php
    // Display table with user data
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr><th>Username</th><th>Email</th><th>Action</th></tr></thead><tbody>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['username']."</td>
                    <td>".$row['email']."</td>
                    <td class='action-icons'>
                        <!-- Edit icon -->
                        <a href='edit_user.php?id=".$row['id']."' class='edit-btn'><i class='fas fa-edit'></i></a>
                        
                        <!-- Delete icon -->
                        <a href='delete_user.php?id=".$row['id']."' class='delete-btn'><i class='fas fa-trash'></i></a>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No accounts found.";
    }

    $conn->close();
    ?>

</body>
</html>
