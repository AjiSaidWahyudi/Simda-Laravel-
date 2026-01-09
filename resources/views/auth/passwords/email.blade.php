<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | SIMDA Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_simda/css/auth.css')}}">
</head>
<body>
    <div class="login-wrapper row g-0">
        <div class="col-md-6 login-left d-flex flex-column justify-content-center">
            <h2>Selamat Datang di SIMDA</h2>
            <p>Sistem Inventaris Daerah untuk pengelolaan aset yang rapi, aman, dan terintegrasi.</p>
        </div>
        <div class="col-md-6 login-right">
            <div class="text-center mb-4">
                <img src="{{asset('admin_simda/logo/logo_color.png')}}" width="72" alt="Logo">
            </div>
            <h4>KIRIM EMAIL UNTUK MEMBUAT PASSWORD BARU</h4>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-person"></i>
                        </span>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email')}}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login w-100 text-white">
                    Kirim Lewat Email
                </button>
            </form>
            <div class="footer-text">
                © 2025 SIMDA Barang — Pemerintah Kota Samarinda
            </div>
        </div>
    </div>
</body>
</html>