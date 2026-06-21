<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - PROGULL</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

<section class="tutorial-card">
    <h3>Cara Menggunakan Website Sebagai Administrator</h3>
    <p>Ikuti langkah berikut untuk menggunakan sistem AdminPROGULL.</p>

    <div class="tutorial-gallery">
        <div class="tutorial-item">
            <img src="{{ asset('assets/img/tutorial1.png') }}" alt="Tutorial 1">
            <h4>Langkah 1</h4>
            <p>Login menggunakan akun administrator.</p>
        </div>

        <div class="tutorial-item">
            <img src="{{ asset('assets/img/tutorial2.png') }}" alt="Tutorial 2">
            <h4>Langkah 2</h4>
            <p>Kelola produk melalui menu Kelola Produk.</p>
        </div>

        <div class="tutorial-item">
            <img src="{{ asset('assets/img/tutorial3.png') }}" alt="Tutorial 3">
            <h4>Langkah 3</h4>
            <p>Tambahkan laporan keuangan dan pantau saldo.</p>
        </div>
    </div>
</section>

<header class="header d-flex align-items-start sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="admin-title">PROGULL Admin</h1>
        <a href="/logout" class="btn-logout">Logout</a>
    </div>
</header>

<main class="admin-dashboard">

    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p class="subtitle">Dashboard Administrasi & Laporan Keuangan</p>

    <!-- NAV ANTAR HALAMAN ADMIN -->
    <section class="admin-cards" style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.dashboard') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Dashboard Keuangan</h3>
        </a>
        <a href="{{ route('admin.products.index') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Kelola Produk</h3>
        </a>
    </section>

    <!-- RINGKASAN -->
    <section class="admin-cards">
        <div class="admin-card">
            <h3>Total Pemasukan</h3>
            <p class="money">Rp 12.500.000</p>
        </div>

        <div class="admin-card">
            <h3>Total Pengeluaran</h3>
            <p class="money red">Rp 4.200.000</p>
        </div>

        <div class="admin-card">
            <h3>Saldo</h3>
            <p class="money green">Rp 8.300.000</p>
        </div>
    </section>

    <!-- FORM LAPORAN -->
    <section class="finance-form">
        <h3>Tambah Laporan Keuangan</h3>

        <form action="/admin/finance/store" method="POST">
    @csrf

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date">
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select name="type">
                    <option>Pemasukan</option>
                    <option>Pengeluaran</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nominal (Rp)</label>
                <input type="number" name="amount" placeholder="Contoh: 500000">
            </div>

            <div class="form-group full">
                <label>Keterangan</label>
                <textarea name="note" placeholder="Contoh: Penjualan Vest MK-II"></textarea>
            </div>

            <button type="submit" class="btn-save">Simpan Laporan</button>
        </form>
    </section>

    <!-- TABEL LAPORAN -->
    <section class="finance-table">
        <h3>Riwayat Laporan</h3>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                    <td>{{ $report['date'] }}</td>
                    <td>{{ $report['type'] }}</td>
                    <td>{{ $report['note'] }}</td>
                    <td class="{{ $report['type'] === 'Pemasukan' ? 'green' : 'red' }}">
                        Rp {{ number_format($report['amount'], 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td>2025-01-05</td>
                    <td>Pemasukan</td>
                    <td>Penjualan Vest Tactical</td>
                    <td class="green">Rp 1.250.000</td>
                </tr>
                <tr>
                    <td>2025-01-06</td>
                    <td>Pengeluaran</td>
                    <td>Beli Bahan Cordura</td>
                    <td class="red">Rp 750.000</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</main>

</body>
</html>
