<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengguna - PROGULL Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        .box { background:#fff; color:#111; border-radius:10px; padding:20px; margin-bottom:20px; }
        .box table { width:100%; border-collapse:collapse; }
        .box th, .box td { padding:10px 8px; border-bottom:1px solid #eee; text-align:left; }
        .badge { color:#fff; padding:3px 10px; border-radius:12px; font-size:.8rem; }
        .btn { background:#4B5320; color:#fff; border:none; border-radius:5px; padding:7px 12px; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn.danger { background:#b3261e; }
        .alert-error { background:#fdecea; color:#b3261e; padding:10px; border-radius:5px; margin-bottom:15px; }
        .alert-success { background:#e8f5e9; color:#1b5e20; padding:10px; border-radius:5px; margin-bottom:15px; }
    </style>
</head>
<body>

<header class="header d-flex align-items-start sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="admin-title">PROGULL Admin</h1>
        <a href="/logout" class="btn-logout">Logout</a>
    </div>
</header>

<main class="admin-dashboard">
    <p><a href="{{ route('admin.dashboard') }}">&larr; Dashboard</a></p>

    <h2>Kelola Pengguna</h2>
    <p class="subtitle">Cari akun, blokir, atau aktifkan kembali akun customer</p>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <section class="box">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" maxlength="100" placeholder="Cari nama atau email">
            <button type="submit" class="btn">Cari</button>
            <a href="{{ route('admin.users.index') }}" style="margin-left:8px;">Reset</a>
        </form>
    </section>

    <section class="box">
        <table>
            <thead>
                <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Terdaftar</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->is_active)
                            <span class="badge" style="background:#1b5e20">Aktif</span>
                        @else
                            <span class="badge" style="background:#b3261e">Diblokir</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at ? $user->created_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        @if ($user->role === 'customer')
                            <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('{{ $user->is_active ? 'Blokir' : 'Aktifkan' }} akun ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $user->is_active ? 'danger' : '' }}">
                                    {{ $user->is_active ? 'Blokir' : 'Aktifkan' }}
                                </button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;">Tidak ada pengguna ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
</main>

</body>
</html>
