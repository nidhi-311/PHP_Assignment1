<?php

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "netflix_signin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from your database table
$sql = "SELECT * FROM Sign_In";
$result = $conn->query($sql);

// Store the fetched data in an array
$data = array();

if ($result->num_rows > 0) {
    // Output the data in an HTML table
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Interests</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["interests"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Close the connection
$conn->close();
?>
