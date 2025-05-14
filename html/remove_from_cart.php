<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

if (!isset($_POST['product_id'])) {
    echo json_encode(['success' => false, 'error' => 'Product ID missing']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'];

try {
    $pdo = new PDO("mysql:host=sql313.infinityfree.com;dbname=if0_38912952_wp997", "if0_38912952", "llonnewhennn");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
