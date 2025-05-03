<?php
session_start();
header('Content-Type: application/json');

// Connect to the database
$pdo = new PDO("mysql:host=localhost;dbname=trendora", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Read incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['id'];
$userId = $_SESSION['user_id'] ?? 0; // Use 0 for guests, or your user system

// Fetch product details from `products` table
$stmt = $pdo->prepare("SELECT name, price, image FROM products WHERE id = :id");
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

error_log("Fetched from products: " . print_r($product, true));

if ($product) {
    // Check if item already exists in the cart
    $check = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $check->execute([$userId, $productId]);
    $existing = $check->fetch();

    if ($existing) {
        // Update quantity if already in cart
        $update = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $update->execute([$userId, $productId]);
    } else {
        // Insert new item into the cart
        $insert = $pdo->prepare("
            INSERT INTO cart (user_id, product_id, product_name, product_price, product_image, quantity)
            VALUES (?, ?, ?, ?, ?, 1)
        ");
        $insert->execute([$userId, $productId, $product['name'], $product['price'], $product['image']]);
    }

    // Get the updated cart count
    $cart_count_query = "SELECT SUM(quantity) as cart_count FROM cart WHERE user_id = ?";
    $cart_stmt = $pdo->prepare($cart_count_query);
    $cart_stmt->execute([$userId]);
    $cart_row = $cart_stmt->fetch(PDO::FETCH_ASSOC);
    $cart_count = $cart_row['cart_count'];

    ob_clean();
    echo json_encode(['success' => true, 'count' => $cart_count]);
    flush();
} else {
    echo json_encode(['error' => 'Product not found']);
}
?>
