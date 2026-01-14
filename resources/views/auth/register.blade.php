@extends('auth.layouts.auth')

@section('title', 'Register | SIMDA Barang')
@section('heading', 'SILAKAN DAFTAR')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    @foreach ([
        ['name', 'Nama', 'text'],
        ['username', 'Username', 'text'],
        ['email', 'Email', 'email'],
    ] as [$field, $label, $type])
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="bi bi-person"></i>
                </span>
                <input type="{{ $type }}"
                       name="{{ $field }}"
                       class="form-control @error($field) is-invalid @enderror"
                       placeholder="{{ $label }}"
                       value="{{ old($field) }}"
                       required>
            </div>
            @error($field)
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    @foreach (['password' => 'Password', 'password_confirmation' => 'Konfirmasi Password'] as $name => $label)
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-light">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password"
                       name="{{ $name }}"
                       class="form-control"
                       placeholder="{{ $label }}"
                       required>
            </div>
        </div>
    @endforeach

    <button class="btn btn-login w-100 text-white">DAFTAR</button>
    <div class="text-center mt-3">
        <span class="text-muted">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">
            Login di sini
        </a>
    </div>
</form>
@endsection
