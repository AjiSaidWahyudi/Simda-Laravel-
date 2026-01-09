@extends('layouts.rumah')

@section('content')
    <div class="card-custom mt-4">
        <div class="table-header">
            <h5>Daftar Ruangan</h5>
            <a href="{{route('kir.create')}}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($kartu_ruang as $index => $kir)
                    <tr>
                        <td>{{ $kartu_ruang->firstItem() + $index }}</td>
                        <td>{{$kir->kode_ruangan}}</td>
                        <td>{{$kir->nama_ruangan}}</td>
                        <td>
                            <form action="{{route('kir.destroy', $kir->id)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('kir.edit', $kir->id)}}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="table-footer mt-3">
                <div class="row align-items-center mt-4">
                    <div class="col-md-6 mb-2 mb-md-0 text-muted">
                        Menampilkan {{ $kartu_ruang->firstItem() }} sampai {{ $kartu_ruang->lastItem() }}
                        dari {{ $kartu_ruang->total() }} data
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                        {{ $kartu_ruang->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection