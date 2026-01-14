<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIMDA Barang')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_simda/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin_simda/css/auth.css') }}">
</head>
<body>
<div class="login-wrapper row g-0">
    <!-- KIRI -->
    <div class="col-md-6 login-left d-flex flex-column justify-content-center">
        <h2>Selamat Datang di SIMDA</h2>
        <p>
            Sistem Inventaris Daerah untuk pengelolaan aset yang rapi,
            aman, dan terintegrasi.
        </p>
    </div>
    <!-- KANAN -->
    <div class="col-md-6 login-right">
        <div class="text-center mb-4">
            <img src="{{ asset('admin_simda/logo/logo_color.png') }}" width="72" alt="Logo">
        </div>
        <h4 class="mb-3">@yield('heading')</h4>
        @yield('content')
        <div class="footer-text">
            © 2025 SIMDA Barang — Pemerintah Kota Samarinda
        </div>
    </div>
</div>
</body>
</html>
