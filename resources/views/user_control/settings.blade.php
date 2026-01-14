@extends('layouts.rumah')

@section('content')
<div class="row g-4">
    <div class="col-md-5">
        <div class="card-custom">
            <h5 class="mb-3">
                <i class="bi bi-person-circle"></i>
                Informasi Akun
            </h5>
            <div class="detail-item mb-2">
                <span class="label">Nama</span>
                <span class="value">{{ $user->name }}</span>
            </div>
            <div class="detail-item mb-2">
                <span class="label">Username</span>
                <span class="value">{{ $user->username }}</span>
            </div>
            <div class="detail-item mb-2">
                <span class="label">Email</span>
                <span class="value">{{ $user->email }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Role</span>
                <span class="value badge bg-primary" style="color: white;">
                    {{ $user->roles->first()->name ?? 'User' }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card-custom">
            <h5 class="mb-3">
                <i class="bi bi-shield-lock"></i>Keamanan Akun
            </h5>
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary">
                        <i class="bi bi-key"></i> Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
