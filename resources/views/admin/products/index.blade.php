<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Produk - PROGULL Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

<header class="header d-flex align-items-start sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="admin-title">PROGULL Admin</h1>
        <a href="/logout" class="btn-logout">Logout</a>
    </div>
</header>

<main class="admin-dashboard">

    <h2>Kelola Produk</h2>
    <p class="subtitle">Tambah, ubah, atau hapus produk yang tampil di Katalog</p>

    <!-- NAV ANTAR HALAMAN ADMIN -->
    <section class="admin-cards" style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.dashboard') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Dashboard Keuangan</h3>
        </a>
        <a href="{{ route('admin.products.index') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Kelola Produk</h3>
        </a>
    </section>

    @if(session('success'))
        <div class="form-group full" style="background:#e6f4ea; padding:.75rem 1rem; border-radius:.5rem; margin-bottom:1rem; color:#2e7d32;">
            {{ session('success') }}
        </div>
    @endif

    <section class="finance-form">
        <h3>
            <a href="{{ route('admin.products.create') }}" class="btn-save" style="text-decoration:none; display:inline-block;">
                + Tambah Produk Baru
            </a>
        </h3>
    </section>

    <!-- TABEL PRODUK -->
    <section class="finance-table">
        <h3>Daftar Produk ({{ $products->count() }})</h3>

        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:60px; height:60px; object-fit:cover; border-radius:.4rem;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category ?? '-' }}</td>
                    <td class="green">{{ $product->formatted_price }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="green">Tampil</span>
                        @else
                            <span class="red">Disembunyikan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        &nbsp;|&nbsp;
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#b71c1c; cursor:pointer; padding:0;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Belum ada produk. Klik "Tambah Produk Baru" untuk mulai mengisi katalog.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</main>

</body>
</html>
