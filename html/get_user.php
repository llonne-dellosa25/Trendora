<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "trendora";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT id, fullname, email FROM users";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Output JSON
header('Content-Type: application/json');
echo json_encode($users);

$conn->close();
?>
