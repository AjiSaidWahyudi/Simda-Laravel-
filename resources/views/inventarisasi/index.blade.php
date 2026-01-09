@extends('layouts.rumah')

@section('content')
    <div class="card-custom mt-4">
        <div class="table-header">
            <h5>Daftar Inventarisasi</h5>
            <a href="{{route('inventarisasi.create')}}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="mb-3">
    <form method="GET" action="{{ route('inventarisasi.index') }}">
        <div class="row g-2 align-items-end">

            <div class="col-md-3">
                <label class="form-label">Kondisi Barang</label>
                <select name="keadaan" class="form-select">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik"
                        {{ request('keadaan') == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                    <option value="Kurang Baik"
                        {{ request('keadaan') == 'Kurang Baik' ? 'selected' : '' }}>
                        Kurang Baik
                    </option>
                    <option value="Rusak Berat"
                        {{ request('keadaan') == 'Rusak Berat' ? 'selected' : '' }}>
                        Rusak Berat
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            @if(request()->has('keadaan'))
            <div class="col-md-3">
                <a href="{{ route('inventarisasi.index') }}"
                   class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
            @endif

        </div>
    </form>
</div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Barang / Register</th>
                        <th>Jenis Barang / Merek / Tipe</th>
                        <th>No. Mesin / Sertifikat / sejenis</th>
                        <th>Bahan</th>
                        <th>Cara Memperoleh / Tahun</th>
                        <th>Ukuran / Satuan</th>
                        <th>Keadaan</th>
                        <th>Nama Barang / Harga</th>
                        <th>QR</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventarisasi as $index => $inv)
                    <tr>
                        <td>{{ $inventarisasi->firstItem() + $index }}</td>
                        <td>{{$inv->kode_barang}} <br> {{$inv->kode_register}}</td>
                        <td>{{$inv->jenis_barang}} <br> {{$inv->merek_tipe}}</td>
                        <td>{{$inv->no_seri}}</td>
                        <td>{{$inv->bahan}}</td>
                        <td>{{$inv->cara_perolehan}} <br> {{$inv->tahun_beli}}</td>
                        <td>{{$inv->ukuran}} {{$inv->satuan}}</td>
                        <td>
                            @if($inv->keadaan === 'Baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($inv->keadaan === 'Kurang Baik')
                                <span class="badge bg-warning text-dark">Kurang Baik</span>
                            @elseif($inv->keadaan === 'Rusak Berat')
                                <span class="badge bg-danger">Rusak Berat</span>
                            @else
                                <span class="badge bg-secondary">{{ $inv->keadaan }}</span>
                            @endif
                        </td>
                        <td>Jumlah: {{$inv->jumlah}} <br> Rp {{ number_format($inv->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($inv->qr_code)
                                <img src="{{ asset('qr_codes/'.$inv->qr_code) }}" width="70">
                            @else
                                <span class="text-danger">QR belum ada</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('inventarisasi.destroy', $inv->id)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('inventarisasi.show', $inv->id)}}" class="btn btn-sm btn-outline-primary">Lihat</a>
                                <a href="{{route('inventarisasi.edit', $inv->id)}}" class="btn btn-sm btn-outline-warning">Edit</a>
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
                        Menampilkan {{ $inventarisasi->firstItem() }} sampai {{ $inventarisasi->lastItem() }}
                        dari {{ $inventarisasi->total() }} data
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                        {{ $inventarisasi->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection