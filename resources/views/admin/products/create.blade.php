<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - PROGULL Admin</title>
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

    <h2>Tambah Produk Baru</h2>
    <p class="subtitle">Produk akan otomatis tampil di halaman Katalog</p>

    <section class="finance-form">
        <h3>Detail Produk</h3>

        @if($errors->any())
            <div class="form-group full" style="background:#fdecea; padding:.75rem 1rem; border-radius:.5rem; color:#b71c1c;">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name" placeholder="Contoh: Taurus A2" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" placeholder="Contoh: vest, belt, addons" value="{{ old('category') }}">
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="price" placeholder="Contoh: 1250000" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label>Gambar Produk</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="description" placeholder="Deskripsi singkat produk, bahan, ukuran, dll.">{{ old('description') }}</textarea>
            </div>

            <div class="form-group full">
                <label>
                    <input type="checkbox" name="is_active" value="1" checked style="width:auto; display:inline-block;">
                    Tampilkan di Katalog
                </label>
            </div>

            <button type="submit" class="btn-save">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" style="margin-left:1rem;">Batal</a>
        </form>
    </section>

</main>

</body>
</html>
