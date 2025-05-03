<?php
session_start();
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=trendora", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    $userId = $_SESSION['user_id'];
    error_log("Fetching cart for user: $userId"); // Debugging: log user ID

    // ✅ Include product_id in the SELECT
    $stmt = $pdo->prepare("SELECT product_id, product_name, product_price, product_image, quantity FROM cart WHERE user_id = ?");
    $stmt->execute([$userId]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Send the data as JSON response
    echo json_encode([
        "success" => true,
        "items" => $items
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
