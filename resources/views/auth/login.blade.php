@extends('auth.layouts.auth')

@section('title', 'Login | SIMDA Barang')
@section('heading', 'SILAKAN LOGIN')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-person"></i>
            </span>
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email"
                   value="{{ old('email') }}"
                   required autofocus>
        </div>
        @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-light">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password"
                   required>
        </div>
        @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-4 form-check">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button class="btn btn-login w-100 text-white">LOGIN</button>
    <div class="text-center mt-3">
        <span class="text-muted">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">
            Daftar di sini
        </a>
    </div>
    <div class="mt-2 text-center">
        <a href="{{ route('password.request') }}" class="small text-decoration-none">
            Lupa Password?
        </a>
    </div>
</form>
@endsection
