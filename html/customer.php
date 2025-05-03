<?php
// Allow all origins
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle pre-flight request (OPTIONS request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

session_start();
$mysqli = new mysqli("localhost", "root", "", "trendora"); // update credentials

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(["error" => "Please log in to view your dashboard."]);
    exit;
}

$email = $_SESSION['email'];

// Fetch user info
$userQuery = "SELECT fullname, email FROM users WHERE email = ?";
$stmt = $mysqli->prepare($userQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($fullname, $email);
$stmt->fetch();
$stmt->close();

// Fetch order history
$orderQuery = "SELECT id, order_date, total_price FROM orders WHERE email = ?";
$stmt2 = $mysqli->prepare($orderQuery);
$stmt2->bind_param("s", $email);
$stmt2->execute();
$orderResult = $stmt2->get_result();
$orderHistory = [];

while ($row = $orderResult->fetch_assoc()) {
    $row['total_price'] = floatval($row['total_price']);
    $orderHistory[] = $row;
}

$stmt2->close();
$mysqli->close();

// Return data as JSON
echo json_encode([
    'fullname' => $fullname,
    'email' => $email,
    'order_history' => $orderHistory
]);
?>
