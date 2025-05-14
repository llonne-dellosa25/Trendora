<?php
header('Content-Type: application/json');

$servername = "sql313.infinityfree.com";
$username = "if0_38912952";
$password = "llonnewhennn";
$dbname = "if0_38912952_wp997";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT name, price, quantity FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}

echo json_encode($products);

$conn->close();
?>
