<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Team – PROGULL Defence Gear</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<!-- HEADER (sama seperti halaman lain) -->
<header id="header" class="header d-flex align-items-start sticky-top">
  <div class="container position-relative d-flex align-items-start">

    <a href="/" class="logo d-flex flex-column align-items-start me-auto">
      <h1 class="sitename">PROGULL</h1>
      <small class="tagline">Defence Gear</small>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/catalog">Catalog</a></li>
        <li><a href="/team.html" class="active">Team</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>

<!-- TEAM SECTION -->
<section class="catalog-page">
  <div class="container">

    <div class="section-title">
      <h2>Our Team</h2>
      <p>Para Pria Hebat di balik WEB PROGULL Defence Gear</p>
    </div>

    <div class="catalog-grid">

      <!-- ANGGOTA TIM -->
      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/team/team-1.jpg') }}" alt="Nama Anggota">
        </div>
        <h3>MUCHAMMAD ABDUH</h3>
        <p class="price">FULL-STACK DEVLOPER</p>
        <p class="description">Mahasiswa UMM yang mengsupport UMKM lokal produsen Gear Milliter lokal dengan membuat sistem web e-commerce dan manajemen team marketing</p>
            {{-- ceritakan biografi singkat anggota tim di sini --}}
        </p>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/team/team-2.jpg') }}" alt="Nama Anggota">
        </div>
        <h3>MARCELL NATHANAEL</h3>
        <p class="price">Dev Assistant dan Electrical Engineer</p>
        <p class="description">Anak SMK yang penuh semangat dan rasa ingin tau di usia muda, belajar sekaligus membantu dalam pengembangan website</p>
            {{-- ceritakan biografi singkat anggota tim di sini --}}
        </p>
      </div>

      <div class="product-card">
        <div class="product-slider">
          <img src="{{ asset('assets/img/team/team-3.jpg') }}" alt="Nama Anggota">
        </div>
        <h3>Tito</h3>
        <p class="price">IT Supervisior</p>
        <p class="description">Seorang profesional IT yang memiliki pengalaman dalam mengelola dan memantau sistem teknologi informasi, serta memberikan bantuan teknis kepada tim pengembang.</p>
            {{-- ceritakan biografi singkat anggota tim di sini --}}
        </p>
      </div>

      <!-- copy-paste div.product-card di atas kalau anggota tim lebih dari 3 -->

    </div>

  </div>
</section>

</body>
</html>
