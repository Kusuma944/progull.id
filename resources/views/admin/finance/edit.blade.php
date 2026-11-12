<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Laporan - PROGULL</title>
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
    <h2>Edit Laporan Keuangan</h2>

    @if ($errors->any())
        <div style="background:#fdecea;color:#b3261e;padding:10px;border-radius:5px;margin-bottom:15px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="finance-form">
        <form action="{{ route('admin.finance.update', $report) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $report->date->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label>Jenis</label>
                <select name="type" required>
                    <option value="Pemasukan" @selected(old('type', $report->type) === 'Pemasukan')>Pemasukan</option>
                    <option value="Pengeluaran" @selected(old('type', $report->type) === 'Pengeluaran')>Pengeluaran</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nominal (Rp)</label>
                <input type="number" name="amount" min="1" value="{{ old('amount', $report->amount) }}" required>
            </div>

            <div class="form-group full">
                <label>Keterangan</label>
                <textarea name="note" maxlength="255">{{ old('note', $report->note) }}</textarea>
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" style="margin-left:10px;">Batal</a>
        </form>
    </section>
</main>

</body>
</html>
