<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - PROGULL</title>
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

    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <p class="subtitle">Dashboard Administrasi & Laporan Keuangan</p>

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

        <formaction="/admin/finance/store" method="POST">
    @csrf

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date">
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select>
                    <option>Pemasukan</option>
                    <option>Pengeluaran</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nominal (Rp)</label>
                <input type="number" placeholder="Contoh: 500000">
            </div>

            <div class="form-group full">
                <label>Keterangan</label>
                <textarea placeholder="Contoh: Penjualan Vest MK-II"></textarea>
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
            </tbody>
        </table>
    </section>

</main>

</body>
</html>
