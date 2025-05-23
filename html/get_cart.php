<?php
session_start();
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38912952_wp997", "if0_38912952", "llonnewhennn");
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
    
// Fix the image path
foreach ($items as &$item) {
    $item['product_image'] = basename($item['product_image']); // now just 'product1.jpg'
}
    // Send the data as JSON response
    echo json_encode([
        "success" => true,
        "items" => $items
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
