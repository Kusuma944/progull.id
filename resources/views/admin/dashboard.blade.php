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
            <img src="{{ asset('assets/img/tutorial4.png') }}" alt="Tutorial 3">
            <h4>Langkah 3</h4>
            <p>Tambahkan laporan keuangan dan pantau saldo.</p>
        </div>

        <div class="tutorial-item">
            <img src="{{ asset('assets/img/tutorial5.png') }}" alt="Tutorial 3">
            <h4>Langkah 3</h4>
            <p>Tambahkan laporan keuangan dan pantau saldo.</p>
        </div>
        
        <div class="tutorial-item">
            <img src="{{ asset('assets/img/tutorial6.png') }}" alt="Tutorial 3">
            <h4>Langkah 3</h4>
            <p>Tambahkan laporan keuangan dan pantau saldo.</p>
        </div> 

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
        <a href="{{ route('admin.orders.index') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Kelola Pesanan</h3>
        </a>
        <a href="{{ route('admin.users.index') }}" class="admin-card" style="text-decoration:none; display:block;">
            <h3>Kelola Pengguna</h3>
        </a>
    </section>

    @if (session('success'))
        <div style="background:#e8f5e9;color:#1b5e20;padding:10px;border-radius:5px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#fdecea;color:#b3261e;padding:10px;border-radius:5px;margin-bottom:15px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FILTER -->
    <section class="finance-form">
        <h3>Filter Laporan</h3>
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}">
            </div>

            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}">
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select name="type">
                    <option value="">Semua</option>
                    <option value="Pemasukan" @selected(request('type') === 'Pemasukan')>Pemasukan</option>
                    <option value="Pengeluaran" @selected(request('type') === 'Pengeluaran')>Pengeluaran</option>
                </select>
            </div>

            <button type="submit" class="btn-save">Terapkan Filter</button>
            <a href="{{ route('admin.dashboard') }}" style="margin-left:10px;">Reset</a>
        </form>
    </section>

    <!-- RINGKASAN -->
    <section class="admin-cards">
        <div class="admin-card">
            <h3>Total Pemasukan</h3>
            <p class="money">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>

        <div class="admin-card">
            <h3>Total Pengeluaran</h3>
            <p class="money red">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>

        <div class="admin-card">
            <h3>Saldo</h3>
            <p class="money {{ $balance >= 0 ? 'green' : 'red' }}">Rp {{ number_format($balance, 0, ',', '.') }}</p>
        </div>
    </section>

    <!-- FORM LAPORAN -->
    <section class="finance-form">
        <h3>Tambah Laporan Keuangan</h3>

        <form action="{{ route('admin.finance.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date" value="{{ old('date') }}" required>
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select name="type" required>
                    <option value="Pemasukan" @selected(old('type') === 'Pemasukan')>Pemasukan</option>
                    <option value="Pengeluaran" @selected(old('type') === 'Pengeluaran')>Pengeluaran</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nominal (Rp)</label>
                <input type="number" name="amount" min="1" value="{{ old('amount') }}" placeholder="Contoh: 500000" required>
            </div>

            <div class="form-group full">
                <label>Keterangan</label>
                <textarea name="note" maxlength="255" placeholder="Contoh: Penjualan Vest MK-II">{{ old('note') }}</textarea>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                <tr>
                    <td>{{ $report->date->format('Y-m-d') }}</td>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->note }}</td>
                    <td class="{{ $report->type === 'Pemasukan' ? 'green' : 'red' }}">
                        Rp {{ number_format($report->amount, 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('admin.finance.edit', $report) }}">Edit</a>
                        <form action="{{ route('admin.finance.destroy', $report) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Hapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:#b3261e;cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada laporan keuangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</main>

</body>
</html>
