<?php
$conn = new mysqli("sql313.infinityfree.com", "if0_38912952", "llonnewhennn", "if0_38912952_wp997");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM orders ORDER BY order_date DESC";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
