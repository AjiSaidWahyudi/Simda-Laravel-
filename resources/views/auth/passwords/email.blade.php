@extends('auth.layouts.auth')

@section('title', 'Lupa Password | SIMDA Barang')
@section('heading', 'KIRIM EMAIL RESET PASSWORD')

@section('content')
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email"
               required>
        @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-login w-100 text-white">
        Kirim Lewat Email
    </button>
    <div class="text-center mt-3">
        <span class="text-muted">Ingat password?</span>
        <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
            Login di sini
        </a>
    </div>
</form>
@endsection
