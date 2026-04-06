<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Catalog – PROGULL Defence Gear</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<!-- HEADER (COPY PASTE NAVBAR KAMU) -->
<header id="header" class="header d-flex align-items-start sticky-top">
  <div class="container position-relative d-flex align-items-start">

    <a href="/" class="logo d-flex flex-column align-items-start me-auto">
      <h1 class="sitename">PROGULL</h1>
      <small class="tagline">Defence Gear</small>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/catalog" class="active">Catalog</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>

<!-- CATALOG SECTION -->
<section class="catalog-page">
  <div class="container">

    <div class="section-title">
      <h2>Product Catalog</h2>
      <p>Tactical & Defence Grade Equipment</p>
    </div>

    <div class="catalog-grid">

      <!-- PRODUCT -->
      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/vest-1.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-2.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-3.jpg') }}">
        </div>
        <h3>Taurus A2</h3>
        <p class="price">Rp 1.250.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/vest-4.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-5.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-6.jpg') }}">
        </div>
        <h3>Skeleton A1</h3>
        <p class="price">Rp 1.150.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/vest-7.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-8.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/vest-9.jpg') }}">
        </div>
        <h3>M2 Progull</h3>
        <p class="price">Rp 950.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      

      <!-- PRODUCT -->
      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/belt-1.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/belt-2.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/belt-3.jpg') }}">
        </div>
        <h3>Hipalus belt</h3>
        <p class="price">Rp 550.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>
      
      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/belt-5.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/belt-6.jpg') }}">
          <img src="{{ asset('assets/img/products/vest/belt-7.jpg') }}">
        </div>
        <h3>Maximus Belt Loreng Malv</h3>
        <p class="price">Rp 650.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>


      <!--- PRODUCT -->

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/addons-1.jpg') }}">
        </div>
        <h3>Pistol Pouch</h3>
        <p class="price">Rp 50.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/addons-2.jpg') }}">
        </div>
        <h3>Utility Pouch</h3>
        <p class="price">Rp 50.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/addons-3.jpg') }}">
        </div>
        <h3>P3K pouch</h3>
        <p class="price">Rp 70.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/products/vest/addons-4.jpg') }}">
        </div>
        <h3>Tandu</h3>
        <p class="price">Rp 50.000</p>
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>

    </div>

  </div>
</section>

</body>
</html>

