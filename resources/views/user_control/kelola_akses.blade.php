@extends('layouts.rumah')

@section('content')
    <div class="card-custom mt-4">
        <div class="table-header">
            <h5>Kelola Akses</h5>
            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalRole">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Role</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $index => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="modalRole" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content card-custom">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-shield-plus"></i>
                                Tambah Role
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('kelola_akses.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Role</label>
                                    <input type="text" name="name" class="form-control" placeholder="Contoh: admin" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection