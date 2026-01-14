<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SIMDA Barang</title>
    <link rel="icon" type="image/x-icon" href="{{asset('admin_simda/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('admin_simda/css/welcome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <div class="welcome-card">
        <div class="welcome-icon">
            <img src="{{ asset('admin_simda/logo/logo_color.png')}}" alt="">
        </div>

        <h1>SIMDA Barang</h1>
        <p>Sistem Informasi Manajemen Daerah<br>Pengelolaan Aset Barang</p>

        <div class="welcome-actions">
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        </div>

        <div class="footer-text">
            © {{ now()->year }} <strong>SIMDA Barang</strong> – Pemerintah Kota Samarinda. All rights reserved.
        </div>
    </div>

</body>
</html>
