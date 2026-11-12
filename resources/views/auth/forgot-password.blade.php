<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - PROGULL</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        body { display:flex; justify-content:center; align-items:center; height:100vh; margin:0;
               background: linear-gradient(135deg, #111 0%, #4B5320 100%); font-family: var(--default-font); }
        .login-container { background:#fff; padding:40px; border-radius:10px; box-shadow:0 10px 25px rgba(0,0,0,.3); width:350px; text-align:center; }
        .login-container h2 { margin-bottom:20px; font-family: var(--heading-font); color:#111; }
        .login-container input { width:90%; padding:12px 15px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; font-size:.9rem; }
        .login-container button { width:100%; padding:12px; border:none; border-radius:5px; background-color:#4B5320; color:#fff; font-weight:bold; font-size:1rem; cursor:pointer; transition:.3s; }
        .login-container button:hover { background-color:#15962b; }
        .login-container .register-link { margin-top:15px; display:block; font-size:.875rem; color:#555; }
        .login-container .register-link:hover { color:#1bbd36; }
        .alert-error { background:#fdecea; color:#b3261e; padding:10px; border-radius:5px; margin-bottom:15px; font-size:.85rem; text-align:left; }
        .alert-success { background:#e8f5e9; color:#1b5e20; padding:10px; border-radius:5px; margin-bottom:15px; font-size:.85rem; text-align:left; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LUPA PASSWORD</h2>
        <p style="font-size:.85rem;color:#555;margin-bottom:15px;">Masukkan email akunmu, kami kirim link untuk reset password.</p>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/forgot-password">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <button type="submit">Kirim Link Reset</button>
        </form>
        <a href="/login" class="register-link">Kembali ke Login</a>
    </div>
</body>
</html>
