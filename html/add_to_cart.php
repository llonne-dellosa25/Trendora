<?php
session_start();

// Database connection
$host = 'localhost'; 
$db = 'trendora'; 
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Decode incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Fetch product details from the database
$stmt = $pdo->prepare("SELECT product_name, product_price, product_image FROM products WHERE product_id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    $name = $product['product_name'];
    $price = $product['product_price'];
    $image = $product['product_image'];

    // Initialize cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update product in the cart
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1
        ];
    }

    // Return updated cart data as JSON
    $cart = array_values($_SESSION['cart']);
    echo json_encode(['cart' => $cart]);
} else {
    echo json_encode(['error' => 'Product not found']);
}
?>
