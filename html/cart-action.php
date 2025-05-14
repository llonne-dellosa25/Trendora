<?php
session_start();
header('Content-Type: application/json');


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$mode = $_POST['mode'] ?? '';

if ($mode === 'fetch') {
    echo json_encode($_SESSION['cart']);
    exit;
}
// Connect to the database
$pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38912952_XXX", "if0_38912952", "llonnewhennn");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the action (either 'get', 'update', or 'remove')
$action = $_POST['action'] ?? '';   

// Default user_id for guests (0 for guests, user_id for logged-in users)
$userId = $_SESSION['user_id'] ?? 0;

switch ($action) {
    case 'get':
        // Fetch cart items for the user
        $stmt = $pdo->prepare("SELECT cart.id, product_name, product_price, product_image, quantity
                               FROM cart
                               JOIN products ON cart.product_id = products.id
                               WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['cart' => $cartItems]);
        break;

    case 'update':
        // Update cart quantity
        $itemId = $_POST['item_id'];
        $newQuantity = $_POST['quantity'];

        // Update the quantity in the cart
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->execute([$newQuantity, $itemId]);

        echo json_encode(['success' => true]);
        break;

    case 'remove':
        // Remove item from cart
        $itemId = $_POST['item_id'];

        // Remove the item from the cart
        $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->execute([$itemId]);

        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
?>
