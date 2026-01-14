@extends('auth.layouts.auth')

@section('title', 'Reset Password | SIMDA Barang')
@section('heading', 'BUAT PASSWORD BARU')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" class="form-control mb-3"
           value="{{ request('email') ?? old('email') }}" required>

    <input type="password" name="password" class="form-control mb-3"
           placeholder="Password Baru" required>

    <input type="password" name="password_confirmation" class="form-control mb-3"
           placeholder="Konfirmasi Password" required>

    <button class="btn btn-login w-100 text-white">Kirim</button>
</form>
@endsection
