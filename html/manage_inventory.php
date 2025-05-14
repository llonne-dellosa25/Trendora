<?php
// Connect to the database
$conn = new mysqli("sql313.infinityfree.com", "if0_38912952", "llonnewhennn", "if0_38912952_wp997");
// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get posted data
$action = $_POST['action'];
$product_id = $_POST['product_id'];

if ($action == 'add') {
    // Increase quantity by 1
    $sql = "UPDATE products SET quantity = quantity + 1 WHERE id = $product_id";
    if ($conn->query($sql) === TRUE) {
        // Redirect to inventory page after adding
        header("Location: inventory.html?msg=Product quantity increased!");
        exit();
    } else {
        echo "Error updating product quantity: " . $conn->error;
    }
} elseif ($action == 'delete') {
    // Decrease quantity by 1, but prevent going below 0
    $sql = "UPDATE products SET quantity = GREATEST(quantity - 1, 0) WHERE id = $product_id";
    if ($conn->query($sql) === TRUE) {
        // Redirect to inventory page after deleting
        header("Location: inventory.html?msg=Product quantity decreased!");
        exit();
    } else {
        echo "Error updating product quantity: " . $conn->error;
    }
}

$conn->close();
?>
