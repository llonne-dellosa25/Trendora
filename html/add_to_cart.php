<?php
session_start();
header('Content-Type: application/json');

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38912952_wp997", "if0_38912952", "llonnewhennn");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Read incoming JSON data
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'])) {
        echo json_encode(['success' => false, 'message' => 'Missing product ID']);
        exit;
    }

    $productId = $data['id'];
    $userId = $_SESSION['user_id'] ?? 0; // Guest = 0

    // Fetch product details
    $stmt = $pdo->prepare("SELECT name, price, image FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        exit;
    }

    // Check if already in cart
    $check = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $check->execute([$userId, $productId]);

    if ($check->fetch()) {
        $update = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $update->execute([$userId, $productId]);
    } else {
        $insert = $pdo->prepare("
            INSERT INTO cart (user_id, product_id, product_name, product_price, product_image, quantity)
            VALUES (?, ?, ?, ?, ?, 1)
        ");
        $insert->execute([$userId, $productId, $product['name'], $product['price'], $product['image']]);
    }

    // Count total items in cart
    $cartCountStmt = $pdo->prepare("SELECT SUM(quantity) AS cart_count FROM cart WHERE user_id = ?");
    $cartCountStmt->execute([$userId]);
    $cartCount = $cartCountStmt->fetch(PDO::FETCH_ASSOC)['cart_count'];

    echo json_encode(['success' => true, 'count' => $cartCount]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error', 'details' => $e->getMessage()]);
}
?>