<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Keranjang – PROGULL Defence Gear</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .cart-page { padding: 40px 0; }
    .cart-box { background:#fff; color:#111; border-radius:10px; padding:24px; max-width:1000px; margin:0 auto; }
    .cart-box table { width:100%; border-collapse:collapse; }
    .cart-box th, .cart-box td { padding:12px 8px; border-bottom:1px solid #eee; text-align:left; vertical-align:middle; }
    .cart-box img { width:64px; height:64px; object-fit:cover; border-radius:6px; margin-right:10px; vertical-align:middle; }
    .cart-box input[type=number] { width:70px; padding:6px; border:1px solid #ccc; border-radius:5px; }
    .cart-btn { background:#4B5320; color:#fff; border:none; border-radius:5px; padding:7px 12px; cursor:pointer; text-decoration:none; display:inline-block; }
    .cart-btn:hover { background:#15962b; }
    .cart-btn.danger { background:#b3261e; }
    .cart-total { text-align:right; font-size:1.2rem; font-weight:bold; margin-top:16px; }
    .alert-error { background:#fdecea; color:#b3261e; padding:10px; border-radius:5px; margin-bottom:15px; }
    .alert-success { background:#e8f5e9; color:#1b5e20; padding:10px; border-radius:5px; margin-bottom:15px; }
  </style>
</head>
<body>

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
        <li><a href="/cart" class="active">Keranjang</a></li>
        <li><a href="/orders">Pesanan Saya</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a href="/logout">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="cart-page">
  <div class="container">
    <div class="cart-box">
      <h2>Keranjang Belanja</h2>

      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
      @endif

      @if ($items->isEmpty())
        <p>Keranjang kamu masih kosong.</p>
        <a href="/catalog" class="cart-btn">Lihat Katalog</a>
      @else
        <table>
          <thead>
            <tr>
              <th>Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Subtotal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
              <td>
                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                {{ $item->product->name }}
              </td>
              <td>{{ $item->product->formatted_price }}</td>
              <td>
                <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:flex;gap:6px;">
                  @csrf
                  @method('PATCH')
                  <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99" required>
                  <button type="submit" class="cart-btn">Ubah</button>
                </form>
              </td>
              <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
              <td>
                <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Hapus item ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="cart-btn danger">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="cart-total">Total: Rp {{ number_format($total, 0, ',', '.') }}</div>

        <div style="text-align:right;margin-top:16px;">
          <a href="/catalog" class="cart-btn">Lanjut Belanja</a>
          @if (\Illuminate\Support\Facades\Route::has('checkout.create'))
            <a href="{{ route('checkout.create') }}" class="cart-btn">Checkout</a>
          @endif
        </div>
      @endif
    </div>
  </div>
</section>

</body>
</html>
