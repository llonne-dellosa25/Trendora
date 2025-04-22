<?php
session_start();

// Database connection
$host = 'localhost'; // Database host
$db = 'trendora'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

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

        // Insert or update product in the database (cart table)
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE product_id = :id");
        $stmt->execute(['id' => $id]);
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingProduct) {
            // Update quantity if product already exists in cart
            $stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :id");
            $stmt->execute([
                'quantity' => $_SESSION['cart'][$id]['quantity'],
                'id' => $id
            ]);
        } else {
            // Insert new product into cart table
            $stmt = $pdo->prepare("INSERT INTO cart (product_id, product_name, price, image, quantity)
                                   VALUES (:id, :name, :price, :image, :quantity)");
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => $_SESSION['cart'][$id]['quantity']
            ]);
        }

        // Calculate total items in the cart
        $totalItems = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalItems += $item['quantity'];
        }

        // Return cart count as JSON
        echo json_encode(['count' => $totalItems]);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }

    exit;
}
?>
