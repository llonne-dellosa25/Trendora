<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trendora</title>

  <!--Bootstrap 5 Only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <!--External CSS -->
  <link rel="stylesheet" href="style.css" />

  <!--Filter Icon-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_list" />
   
</head>
<body>
  <!-- Search Header -->
  <div class="header">
    <nav class="top-bar fixed-top">
      <div class="logo">TRENDORA</div>
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Jeans for Teens">
      <button><i class="fas fa-search"></i></button>
    </div>
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
    
    <!-- Carousel-->
    <div class="carousel-container">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="listing-product-carousel/slide-01.jpg" class="d-block w-100" alt="Trend 1">
          </div>
          <div class="carousel-item">
            <img src="listing-product-carousel/slide-02.jpg" class="d-block w-100" alt="Trend 2">
          </div>
          <div class="carousel-item">
            <img src="listing-product-carousel/slide-03.jpg" class="d-block w-100" alt="Trend 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>



  <!--Category Navigation -->
  <nav class="category-nav">
    <div class="nav-links">
    <div class="nav-links">
    <a href="#">WOMEN</a>
    <a href="#men">MEN</a>
    <a href="#footwear">FOOTWEAR</a>
    <a href="#groceries">JEWELRIES</a>
    <a href="#beauty">BEAUTY & PERSONAL CARE</a>
    <a href="#kids">BOOKS</a>
    <a href="#appliances">ELECTRONIC GADGETS</a>
  </div>
    <div class="actions">
      <span class="material-symbols-outlined">filter_list</span>
  </div>
  </nav>

  <!--  Product Section -->
  <main class="container category-section">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-4">
      <!-- Repeatable Product Card -->
      <div class="col">
        <div class="card product-card">
          <img src="products/w-1.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>
      <!-- Duplicate this block as needed -->
      <div class="col">
        <div class="card product-card">
          <img src="products/w-2.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card product-card">
          <img src="products/w-3.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card product-card">
          <img src="products/w-4.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card product-card">
          <img src="products/w-5.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card product-card">
          <img src="products/w-6.jpg" class="card-img-top" alt="Product">
          <div class="card-body text-center">
            <h6 class="card-title mb-1">Product Name</h6>
            <p class="card-text text-muted">₱0.00</p>
            <a href="product-page.html" class="btn btn-sm btn-dark">Add to Cart</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Trendora. All rights reserved.</p>
  </footer>

  <!-- JS -->
  <script>
    const phrases = [
      "Jeans For Teens",
      "Stylish Tops",
      "Trendy Accessories",
      "Affordable Fashion",
      "Best Deals Today"
    ];
    let index = 0;
    const input = document.getElementById("searchInput");
    setInterval(() => {
      if (input) {
        index = (index + 1) % phrases.length;
        input.placeholder = phrases[index];
      }
    }, 2000);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
