<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Banijo Farm</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary-blue: #0d6efd;
            --light-gray: #f8f9fa;
            --dark-text: #343a40;
            --secondary-text: #6c757d;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
        }

        .main-wrapper {
            display: flex;
        }

        /* === Sidebar Styling === */
        .sidebar {
            width: 280px;
            background-color: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 1.5rem;
            border-right: 1px solid #dee2e6;
        }

        .sidebar-header {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--dark-text);
        }

        .sidebar-header .fa-sheep {
            color: var(--primary-blue);
        }

        .sidebar .nav-link {
            color: var(--secondary-text);
            font-weight: 600;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link .bi {
            margin-right: 1rem;
            font-size: 1.3rem;
            width: 24px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: var(--primary-blue);
        }

        /* === Main Content Styling === */
        .main-content-wrapper {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 1.5rem;
        }

        .top-navbar {
            background-color: #fff;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .top-navbar .form-control {
            border: none;
        }

        .top-navbar .profile-pic {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">
        <div class="sidebar">
            <div class="sidebar-header mb-4 d-flex align-items-center">
                <i class="fa-solid fa-sheep me-3"></i>
                <span>Banijo Farm</span>
            </div>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item"><a href="{{ url('/') }}"
                        class="nav-link {{ request()->is('/') ? 'active' : '' }}"><i
                            class="bi bi-speedometer2"></i>Dashboard</a></li>
                <li class="nav-item"><a href="{{ url('/pemasukan') }}"
                        class="nav-link {{ request()->is('pemasukan*') ? 'active' : '' }}"><i
                            class="bi bi-box-arrow-in-down"></i>Kelola Pemasukan</a></li>
                <li class="nav-item"><a href="{{ url('/pengeluaran') }}"
                        class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}"><i
                            class="bi bi-box-arrow-up"></i>Kelola Pengeluaran</a></li>
                <li class="nav-item"><a href="{{ url('/stok') }}"
                        class="nav-link {{ request()->is('stok*') ? 'active' : '' }}"><i
                            class="bi bi-boxes"></i>Manajemen Stok</a></li>
                <li class="nav-item"><a href="{{ url('/pelanggan-supplier') }}"
                        class="nav-link {{ request()->is('pelanggan-supplier*') ? 'active' : '' }}"><i
                            class="bi bi-people-fill"></i>Pelanggan & Supplier</a></li>
                <li class="nav-item"><a href="{{ url('/laporan') }}"
                        class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}"><i
                            class="bi bi-journal-text"></i>Laporan Keuangan</a></li>
                <li class="nav-item"><a href="{{ url('/notifikasi') }}"
                        class="nav-link {{ request()->is('notifikasi*') ? 'active' : '' }}"><i
                            class="bi bi-bell-fill"></i>Pengingat & Notifikasi</a></li>
            </ul>
        </div>

        <div class="main-content-wrapper">
            <nav class="top-navbar d-flex justify-content-end align-items-center">
                {{-- Bagian Search Bar sudah dihapus dari sini --}}
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link"><i class="bi bi-gear fs-5 me-3"></i></a>
                    <a href="#" class="nav-link"><i class="bi bi-bell fs-5 me-4"></i></a>
                    <div class="me-2 text-end d-none d-md-block">
                        <div class="fw-bold">Pemilik Usaha</div>
                        <div class="text-muted small">Admin</div>
                    </div>
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Profile" class="profile-pic">
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>