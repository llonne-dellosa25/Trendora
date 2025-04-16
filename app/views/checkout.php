<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout - Trendora</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/checkout.css" />
  <!--External CSS -->
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <!-- Header -->
  <div class="header">
    <nav class="top-bar fixed-top">
      <div class="logo">TRENDORA</div>
    <div class="icons">
      <div class="icon"><i class="fas fa-user"></i></div>
      <div class="icon">
        <i class="fa-solid fa-bag-shopping"></i>
        <span class="cart-count">30</span>
      </div>
      <div class="icon">
        <i class="fas fa-heart"></i>
        <span class="cart-count">0</span>
      </div>
    </div>
  </div>
    </nav>

  <!-- Checkout Form -->
  <form action="checkout.php" method="POST">
    <main class="main">
      <!-- Left: Form Section -->
      <section class="form-section">
        <h1>Checkout</h1>

        <!-- Contact Info -->
        <div class="form-block">
          <h2>1. Contact Information</h2>
          <div class="grid grid-cols-2 gap-4">
            <input type="text" name="first_name" placeholder="First Name" class="input" required>
            <input type="text" name="last_name" placeholder="Last Name" class="input" required>
            <input type="text" name="phone" placeholder="Phone" class="input">
            <input type="email" name="email" placeholder="E-mail" class="input" required>
          </div>
        </div>

        <!-- Delivery -->
        <div class="form-block">
          <h2>2. Delivery Method</h2>
          <div class="payment-method">
            <label><input type="radio" name="delivery_method" value="store" required> Store</label>
            <label><input type="radio" name="delivery_method" value="delivery"> Delivery</label>
          </div>
          <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="date" name="delivery_date_start" class="input">
            <input type="date" name="delivery_date_end" class="input">
          </div>
          <div class="grid grid-cols-3 gap-4">
            <input type="text" name="city" placeholder="City" class="input">
            <input type="text" name="address" placeholder="Address" class="input">
            <input type="text" name="zip" placeholder="Zip Code" class="input">
          </div>
        </div>

        <!-- Payment -->
        <div class="form-block">
          <h2>3. Payment Method</h2>
          <div class="payment-method flex-wrap">
            <label><input type="radio" name="payment_method" value="cod" required> Cash on Delivery</label>
            <label><input type="radio" name="payment_method" value="gcash"><img src="<?php echo BASE_URL; ?>products/gcash.jpg" alt="GCash" class="h-6 inline" /></label>
            <label><input type="radio" name="payment_method" value="maya"><img src="<?php echo BASE_URL; ?>products/maya.jpg" alt="GCash" class="h-6 inline" /></label>
            <label><input type="radio" name="payment_method" value="paypal"><img src="<?php echo BASE_URL; ?>products/Paypal.jpg" alt="GCash" class="h-6 inline" /></label>
          </div>
        </div>
      </section>

      <!-- Right: Order Summary -->
      <aside class="summary-section">
        <h2>Order Summary</h2>
        <div class="product-image">
        <img src="<?php echo BASE_URL; ?>products/s1.jpeg" alt="Product"/>
        </div>
        <p>Product Name and Categories</p>

        <!-- Size & Color -->
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label>Size</label>
            <select name="size" required>
              <option disabled selected>Choose</option>
              <option value="s">Small</option>
              <option value="m">Medium</option>
              <option value="l">Large</option>
              <option value="xl">XL</option>
            </select>
          </div>
          <div>
            <label>Color</label>
            <select name="color" required>
              <option disabled selected>Choose</option>
              <option value="red">Red</option>
              <option value="blue">Blue</option>
              <option value="black">Black</option>
            </select>
          </div>
        </div>

        <div class="border-t my-2"></div>
        <div class="space-y-2 text-sm">
          <div class="flex justify-between"><span>Subtotal</span><span>120</span></div>
          <div class="flex justify-between"><span>Discount</span><span>10</span></div>
          <div class="flex justify-between"><span>Shipping</span><span>33</span></div>
          <div class="flex justify-between font-bold"><span>Total</span><span>143</span></div>
        </div>

        <!-- Hidden Inputs -->
        <div class="mt-4 space-y-2 text-sm">
          <div>
            <label>Product Name:</label>
            <input type="text" name="product_name" value="Sample Product" readonly>
          </div>
          <div>
            <label>Product ID:</label>
            <input type="text" name="product_id" value="123" readonly>
          </div>
          <div>
            <label>Price:</label>
            <input type="text" name="price" value="143" readonly>
          </div>
        </div>

        <!-- Checkout Button -->
        <button type="submit" class="checkout-btn">Checkout</button>

        <!-- Terms -->
        <div class="terms">
          <label><input type="checkbox" required> I accept the terms of the user agreement</label>
        </div>
      </aside>
    </main>
  </form>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-left">
      <a href="#">ABOUT US</a>
      <a href="#">CONTACT US</a>
    </div>
    <div class="footer-center">
      © 2025 TRENDORA. All rights reserved.
    </div>
    <div class="footer-right">
      <span>FOLLOW US</span>
      <div class="icons">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-x-twitter"></i>
      </div>
    </div>
  </footer>
</body>
</html>
