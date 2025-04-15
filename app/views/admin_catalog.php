<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <title>Trendora Seller Center</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  

  <style>
   
   .header {
     background-color: #270a47; 
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%; 
    margin: 0;    
     }
    .header h1 {
      margin: 0;
    }
    .header .top-nav {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .topbar-input {
    padding: 5px 10px; 
    width: 300px;      
    border-radius: 5px;
    border: none;
    }
    .menu {
      background-color: #270a47;
      color: white;
      display: flex;
      padding: 10px 20px;
      gap: 40px;
    }
    .menu a {
      color: white;
      text-decoration: none;
    }
    .catalog-section {
      padding: 30px;
    }
    .catalog-title {
      font-size: 20px;
      color: #6a1bbf;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .catalog {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 20px;
    }
    .product-card {
      background-color: #f5eaf8;
      border-radius: 8px;
      height: 150px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      overflow: hidden;
    }
    .product-card-footer {
      background-color: #b060e6;
      color: white;
      padding: 10px;
      font-size: 12px;
    }
    .footer {
      background-color: #270a47;
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: rgb(250, 247, 247);
      border-top: 1px solid #ccc;
      margin-top: 30px;
    }
    .footer-top {
      display: flex;
      justify-content: space-between;
      padding: 0 50px;
      margin-bottom: 10px;
    }
    .footer-bottom {
      display: flex;
      justify-content: center;
      gap: 10px;
    }
  </style>
</head>
<body>
   <!-- Header -->
  <div class="header">
    <div>
      <h1>TRENDORA <br><span style="font-size:20px;">CENTER</span></h1>
    </div>
    <div class="top-nav">
      <input type="text" placeholder="" class="topbar-input" />
      <span>Notifications</span>
      <span>Help</span>
      <span>Account</span>
    </div>
  </div>

<!-- Menus -->
  <div class="menu">
    <a href="dashboard.html">Admin</a>
    <a href="users.html">Product Ratings</a>
    <a href="admin_catalog.html" class="active">Catalog</a>
    <a href="inventory.html" >Inventory</a>
    <a href="product_order.html">Orders</a>
  </div>

 <!-- Catalog Section -->
  <div class="catalog-section">
    <div class="catalog-title">Catalog</div>
    <div class="catalog">
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
    <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
      <div class="product-card">
        <div class="product-card-footer">Price<br />Description</div>
      </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-left">
      <div>ABOUT US</div>
      <div>CONTACT US</div>
    </div>
    <div class="footer-center">
      2025 TRENDORA.
      <div>All rights reserved.</div>   
    </div>
    <div class="footer-right">
      <span>FOLLOW US</span>
      <div class="icons">
        <span><i class="fab fa-facebook-f"></i></span>
        <span><i class="fab fa-instagram"></i></span>
        <span><i class="fab fa-x-twitter"></i></span>
      </div>      
    </div>

</body>
</html>
