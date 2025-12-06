<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Aplikasi Perpustakaan FTIK USM')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-blue: #0f4332; /* now primary green */
            --secondary-blue: #1f6a4b;
            --light-blue: #e3f3e8;
            --accent-blue: #7ab899;
            --dark-gray: #1c2b23;
            --light-gray: #f4f2ea;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #eaf6ef 50%, var(--light-gray) 100%);
            color: var(--dark-gray);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, var(--primary-blue) 0%, var(--secondary-blue) 40%, var(--accent-blue) 100%);
            color: var(--white);
            padding: 0;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu .nav-item {
            margin: 0.25rem 0;
        }

        .sidebar-menu .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--white);
        }

        .sidebar-menu .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            border-left-color: var(--white);
            font-weight: 600;
        }

        .sidebar-menu .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 1.5rem 2rem 2rem;
            transition: margin-left 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            max-width: 1200px;
            margin: 0 auto 1.25rem;
            background: var(--white);
            padding: 0.85rem 1.75rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 1.5rem;
            z-index: 999;
        }

        .top-navbar .navbar-brand {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 1.25rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu .btn-logout {
            background: #ef4444;
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .user-menu .btn-logout:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* Content Wrapper */
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.75rem 1.75rem 2.25rem;
            border-radius: 1.25rem;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        /* Card Styles */
        .card-modern {
            background: var(--white);
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: var(--white);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
        }

        .card-body-modern {
            padding: 1.5rem;
        }

        /* Button Styles */
        .btn-primary-modern {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-modern:hover {
            background: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3);
        }

        .btn-success-modern {
            background: #10b981;
            border: none;
            color: var(--white);
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success-modern:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }

        /* Table Styles */
        .table-modern {
            background: var(--white);
            border-radius: 0.9rem;
            overflow: hidden;
        }

        .table-modern thead {
            background: var(--light-blue);
        }

        .table-modern thead th {
            color: var(--primary-blue);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem;
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background: var(--light-gray);
            transform: scale(1.01);
        }

        .table-modern tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e5e7eb;
        }

        /* Form Styles */
        .form-label {
            color: var(--dark-gray);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        /* Badge Styles */
        .badge-modern {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem 1.25rem 1.5rem;
            }

            .top-navbar {
                max-width: 100%;
                margin: 0 0 1rem;
                border-radius: 0.9rem;
                top: 0.75rem;
            }

            .content-wrapper {
                max-width: 100%;
                margin: 0;
                padding: 1.25rem 1rem 1.75rem;
                border-radius: 1rem;
            }
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h4>
                <i class="bi bi-book"></i>
                Perpustakaan FTIK
            </h4>
        </div>
        <nav class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('perpus') || request()->is('perpus/*') ? 'active' : '' }}" href="{{ url('perpus') }}">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('buku*') ? 'active' : '' }}" href="{{ url('buku') }}">
                        <i class="bi bi-book"></i>
                        <span>Kelola Buku</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}" href="{{ url('anggota') }}">
                        <i class="bi bi-people"></i>
                        <span>Kelola Anggota</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pinjam*') ? 'active' : '' }}" href="{{ url('pinjam') }}">
                        <i class="bi bi-journal-text"></i>
                        <span>Transaksi Peminjaman</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div>
                <button class="btn btn-link d-md-none" type="button" id="sidebarToggle">
                    <i class="bi bi-list" style="font-size: 1.5rem; color: var(--primary-blue);"></i>
                </button>
                <span class="navbar-brand d-none d-md-inline">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="user-menu">
                <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle?.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>

