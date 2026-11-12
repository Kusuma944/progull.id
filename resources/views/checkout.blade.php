<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout – PROGULL Defence Gear</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .page-section { padding: 40px 0; }
    .box { background:#fff; color:#111; border-radius:10px; padding:24px; max-width:1000px; margin:0 auto; }
    .box table { width:100%; border-collapse:collapse; margin-top:12px; }
    .box th, .box td { padding:10px 8px; border-bottom:1px solid #eee; text-align:left; vertical-align:middle; }
    .box label { display:block; font-weight:600; margin:12px 0 4px; }
    .box input[type=text], .box input[type=tel], .box textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:5px; }
    .btn { background:#4B5320; color:#fff; border:none; border-radius:5px; padding:8px 14px; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn:hover { background:#15962b; }
    .btn.danger { background:#b3261e; }
    .badge { color:#fff; padding:3px 10px; border-radius:12px; font-size:.8rem; }
    .alert-error { background:#fdecea; color:#b3261e; padding:10px; border-radius:5px; margin-bottom:15px; }
    .alert-success { background:#e8f5e9; color:#1b5e20; padding:10px; border-radius:5px; margin-bottom:15px; }
    .total { text-align:right; font-size:1.2rem; font-weight:bold; margin-top:16px; }
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
        <li><a href="/cart">Keranjang</a></li>
        <li><a href="/orders">Pesanan Saya</a></li>
        <li><a href="/logout">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="page-section">
  <div class="container">
    <div class="box">
      <h2>Checkout</h2>
      @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
      @endif

      <table>
        <thead><tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr></thead>
        <tbody>
          @foreach ($items as $item)
          <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->product->formatted_price }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="total">Total: Rp {{ number_format($total, 0, ',', '.') }}</div>

      <h3 style="margin-top:24px;">Data Pengiriman</h3>
      <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <label>Nama Penerima</label>
        <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}" maxlength="100" required>

        <label>Nomor Telepon (angka 9-15 digit)</label>
        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08123456789" required>

        <label>Alamat Lengkap (min. 10 karakter)</label>
        <textarea name="address" rows="3" maxlength="255" required>{{ old('address') }}</textarea>

        <label>Catatan (opsional)</label>
        <textarea name="note" rows="2" maxlength="255">{{ old('note') }}</textarea>

        <div style="margin-top:18px;">
          <button type="submit" class="btn">Buat Pesanan</button>
          <a href="{{ route('cart.index') }}" class="btn" style="background:#777;">Kembali ke Keranjang</a>
        </div>
      </form>
    </div>
  </div>
</section>

</body>
</html>
