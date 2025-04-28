<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo ''; // No items
    exit;
}

foreach ($_SESSION['cart'] as $index => $item) {
    $totalPrice = $item['price'] * $item['quantity'];
    echo "
    <tr>
        <td><input type='checkbox' class='item-checkbox' data-index='{$index}' /></td>
        <td>{$item['name']}</td>
        <td>{$item['quantity']}</td>
        <td>₱" . number_format($totalPrice, 2) . "</td>
        <td><button class='btn btn-danger btn-sm' onclick='removeCartItem({$index})'>Remove</button></td>
    </tr>
    ";
}
?>
