<?php
session_start();

$total = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

echo json_encode(['total' => $total]);
?>
