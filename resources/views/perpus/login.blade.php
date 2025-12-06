<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Aplikasi Perpustakaan FTIK USM</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --coffee-dark: #0f4332;
            --coffee: #1f6a4b;
            --coffee-light: #7ab899;
            --bg-cream: #f4f2ea;
            --bg-dots: rgba(15, 67, 50, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(155deg, var(--bg-cream) 0%, #e3f3e8 45%, var(--bg-cream) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(var(--bg-dots) 2px, transparent 2px),
                radial-gradient(var(--bg-dots) 1px, transparent 1px);
            background-size: 80px 80px, 120px 120px;
            opacity: 0.4;
        }

        .auth-wrapper {
            position: relative;
            width: min(100%, 1100px);
            background: #fff;
            border-radius: 2.5rem;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
        }

        .auth-panel {
            flex: 1;
            padding: 3.5rem 3rem;
        }

        .auth-panel.light {
            background: #fff;
        }

        .auth-panel.dark {
            background: var(--coffee-dark);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 1.5rem;
        }

        .auth-panel.dark h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .auth-panel.dark p {
            max-width: 320px;
            color: rgba(255, 255, 255, 0.85);
        }

        .auth-panel.light h1 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--coffee);
        }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-login button {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid rgba(15, 67, 50, 0.2);
            background: transparent;
            color: var(--coffee);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-login button:hover {
            background: rgba(122, 184, 153, 0.15);
            transform: translateY(-2px);
        }

        .divider-text {
            color: var(--coffee-light);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            margin: 1rem 0 1.5rem;
        }

        .form-control {
            border: 1px solid rgba(31, 106, 75, 0.2);
            border-radius: 0.8rem;
            padding: 0.85rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--coffee-light);
            box-shadow: none;
        }

        label {
            font-weight: 600;
            color: var(--coffee);
            margin-bottom: 0.4rem;
        }

        .forgot {
            text-align: right;
            margin-top: 0.5rem;
        }

        .forgot a {
            color: var(--coffee-light);
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot a:hover {
            color: var(--coffee);
        }

        .btn-login {
            width: 100%;
            background: var(--coffee-dark);
            color: #fff;
            border-radius: 999px;
            padding: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            border: none;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #2d1d18;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 0.8rem;
            border: none;
            background: #ffe7e7;
            color: #873636;
        }

        @media (max-width: 992px) {
            .auth-wrapper {
                flex-direction: column;
            }

            .auth-panel {
                padding: 2.5rem 2rem;
            }

            .auth-panel.dark {
                border-radius: 0 0 2.5rem 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-panel light">
            <p class="text-uppercase fw-semibold text-muted mb-2" style="letter-spacing: 0.2em;">Selamat datang</p>
            <h1>Masuk ke Sistem Perpustakaan</h1>

            <p class="divider-text">Silakan login dengan akun petugas / admin</p>

            @if(session('loginError'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('loginError') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('login') }}" method="POST" accept-charset="utf-8">
                @csrf

                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text"
                           name="username"
                           id="username"
                           class="form-control"
                           placeholder="Masukkan username"
                           required
                           autofocus>
                </div>

                <div class="mb-2">
                    <label for="password">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>

                <button type="submit" name="btn_simpan" class="btn btn-login">
                    MASUK
                </button>
            </form>
        </div>

        <div class="auth-panel dark">
            <h2>Selamat Datang di Perpustakaan</h2>
            <p>Kelola koleksi buku, data anggota, dan transaksi peminjaman melalui dashboard yang nyaman digunakan.</p>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
