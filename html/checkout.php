<?php
// 1. Database connection details
$servername = "sql313.infinityfree.com";  // Use 'localhost' or '127.0.0.1'
$username = "if0_38912952";         // Default username in XAMPP is 'root'
$password =  "llonnewhennn";             // Default password is an empty string for 'root'
$dbname = "if0_38912952_XXX";       // Your database name
$port = 3306;               // Default port for MySQL is 3306 unless you've changed it


// 2. Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

// 3. Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 4. Get POST data
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$delivery_method = $_POST['delivery_method'] ?? '';
$delivery_date_start = $_POST['delivery_date_start'] ?? '';
$delivery_date_end = $_POST['delivery_date_end'] ?? '';
$city = $_POST['city'] ?? '';
$address = $_POST['address'] ?? '';
$zip = $_POST['zip'] ?? '';
$payment_method = $_POST['payment_method'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$product_id = $_POST['product_id'] ?? '';
$product_price = $_POST['price'] ?? ''; // Changed 'price' to 'product_price'

// Calculate total price (if necessary, e.g. adding shipping, discounts, etc.)
$total_price = $product_price; // You can modify this logic based on your needs

// 5. Insert data into `orders` table
$sql = "INSERT INTO orders (
    first_name, last_name, email, phone,
    delivery_method, delivery_date_start, delivery_date_end,
    city, address, zip_code,
    payment_method, product_name, product_id, product_price, total_price
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param(
    "ssssssssssssdds", // Adjusted for decimal for 'product_price' and 'total_price'
    $first_name, $last_name, $email, $phone,
    $delivery_method, $delivery_date_start, $delivery_date_end,
    $city, $address, $zip,
    $payment_method, $product_name, $product_id, $product_price, $total_price
);

if ($stmt->execute()) {
    echo "✅ Order submitted successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}

// 6. Close connection
$stmt->close();
$mysqli->close();
