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

      @forelse($products as $product)
      <div class="product-card">
        <div class="product-slider">
          <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>
        <h3>{{ $product->name }}</h3>
        <p class="price">{{ $product->formatted_price }}</p>
        @if($product->description)
          <p class="description">{{ Str::limit($product->description, 90) }}</p>
        @endif
        <a href="/contact" class="buy-btn">Buy Now</a>
      </div>
      @empty
      <p style="text-align:center; width: 310%;color:#ffffff;">Belum ada produk yang tersedia saat ini.</p>
      @endforelse

    </div>

  </div>
</section>

</body>
</html>
