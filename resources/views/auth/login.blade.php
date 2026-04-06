<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PROGULL</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        /* Full screen center */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #111 0%, #4B5320 100%);
            font-family: var(--default-font);
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-family: var(--heading-font);
            color: #111;
        }

        .login-container input {
            width: 90%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #4B5320;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container button:hover {
            background-color: #15962b;
        }

        .login-container .register-link {
            margin-top: 15px;
            display: block;
            font-size: 0.875rem;
            color: #555;
        }

        .login-container .register-link:hover {
            color: #1bbd36;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>PROGULL DEFENCE ADMIN</h2>
        <form method="POST" action="/login">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="/register" class="register-link">Belum punya akun? Registrasi Sekarang</a>
    </div>
</body>
</html>
