<?php
// 1. Start session to access the cart data
session_start();

// 2. Database connection details
$servername = "localhost";  // Use 'localhost' or '127.0.0.1'
$username = "root";         // Default username in XAMPP is 'root'
$password = "";             // Default password is an empty string for 'root'
$dbname = "trendora";       // Your database name
$port = 3306;               // Default port for MySQL is 3306 unless you've changed it

// 3. Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

// 4. Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 5. Calculate total price from the session cart
$total_price = 0;

// Make sure cart exists and isn't empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

?>

<!-- Display Cart Items in Checkout Form -->
<h3>Your Cart</h3>
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the cart items and display each one
        foreach ($_SESSION['cart'] as $item) {
            $productName = htmlspecialchars($item['name']);
            $productPrice = $item['price'];
            $productQuantity = $item['quantity'];
            $productTotal = $productPrice * $productQuantity;
            $total_price += $productTotal;
            ?>

            <tr>
                <td><?php echo $productName; ?></td>
                <td><?php echo number_format($productPrice, 2); ?></td>
                <td><?php echo $productQuantity; ?></td>
                <td><?php echo number_format($productTotal, 2); ?></td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<h4>Total: $<?php echo number_format($total_price, 2); ?></h4>

<!-- Billing Details Form -->
<h3>Billing Details</h3>
<form action="checkout.php" method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone"><br>

    <label for="city">City:</label>
    <input type="text" name="city"><br>

    <label for="address">Address:</label>
    <textarea name="address" required></textarea><br>

    <label for="zip">Zip Code:</label>
    <input type="text" name="zip"><br>

    <label for="delivery_method">Delivery Method:</label>
    <select name="delivery_method" required>
        <option value="standard">Standard</option>
        <option value="express">Express</option>
    </select><br>

    <label for="delivery_date_start">Delivery Start Date:</label>
    <input type="date" name="delivery_date_start"><br>

    <label for="delivery_date_end">Delivery End Date:</label>
    <input type="date" name="delivery_date_end"><br>

    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" required>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
        <option value="cash_on_delivery">Cash on Delivery</option>
    </select><br>

    <!-- Hidden input to store cart product details -->
    <?php
    foreach ($_SESSION['cart'] as $item) {
        echo "<input type='hidden' name='product_id[]' value='" . $item['id'] . "'>";
        echo "<input type='hidden' name='product_name[]' value='" . $item['name'] . "'>";
        echo "<input type='hidden' name='product_price[]' value='" . $item['price'] . "'>";
        echo "<input type='hidden' name='product_quantity[]' value='" . $item['quantity'] . "'>";
    }
    ?>

    <input type="submit" value="Place Order">
</form>

<?php
// 6. Process the order after form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 6.1 Get user data from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $delivery_method = $_POST['delivery_method'];
    $delivery_date_start = $_POST['delivery_date_start'];
    $delivery_date_end = $_POST['delivery_date_end'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $payment_method = $_POST['payment_method'];

    // 6.2 Insert the order data into the 'orders' table
    $sql = "INSERT INTO orders (
        first_name, last_name, email, phone,
        delivery_method, delivery_date_start, delivery_date_end,
        city, address, zip_code,
        payment_method, total_price
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssd", // Adjusted for decimal for 'total_price'
        $first_name, $last_name, $email, $phone,
        $delivery_method, $delivery_date_start, $delivery_date_end,
        $city, $address, $zip,
        $payment_method, $total_price
    );

    if ($stmt->execute()) {
        // 6.3 After inserting order, get the order ID
        $order_id = $stmt->insert_id;

        // 6.4 Insert products from the cart into 'order_items' table
        foreach ($_POST['product_id'] as $index => $product_id) {
            $product_name = $_POST['product_name'][$index];
            $product_price = $_POST['product_price'][$index];
            $product_quantity = $_POST['product_quantity'][$index];

            $stmt_items = $mysqli->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_price, quantity)
                VALUES (?, ?, ?, ?, ?)");

            $stmt_items->bind_param("iisdi", $order_id, $product_id, $product_name, $product_price, $product_quantity);
            $stmt_items->execute();
        }

        // Clear cart after order
        unset($_SESSION['cart']);

        echo "✅ Order submitted successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // 6.5 Close connection
    $stmt->close();
    $mysqli->close();
}
?>
