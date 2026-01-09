@extends('layouts.rumah')

@section('content')
<div class="card-custom mb-4">
    <div class="table-header">
        <h5>Detail Inventaris #{{ $inventarisasi->id }}</h5>
        <a href="#" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="row g-4 mt-2">
        <div class="col-md-4 text-center">
            <div class="detail-media">
                <img src="{{ asset('gambar_barang/'.$inventarisasi->gambar) }}" alt="Foto Barang" class="detail-image mb-3">
                <p class="mb-1 fw-semibold">QR Code</p>
                <img src="{{ asset('qr_codes/'.$inventarisasi->qr_code) }}" class="qr-image" alt="QR Code">
            </div>
        </div>
        <div class="col-md-8">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Ruangan</span>
                        <span class="value">{{ $inventarisasi->kartu_ruang->nama_ruangan ?? '-' }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Kode Barang</span>
                        <span class="value">{{ $inventarisasi->kode_barang }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Kode Register</span>
                        <span class="value">{{ $inventarisasi->kode_register }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Jenis Barang</span>
                        <span class="value">{{ $inventarisasi->jenis_barang }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Merek / Tipe</span>
                        <span class="value">{{ $inventarisasi->merek_tipe }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">No. Seri</span>
                        <span class="value">{{ $inventarisasi->no_seri }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Bahan</span>
                        <span class="value">{{ $inventarisasi->bahan }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Cara Perolehan</span>
                        <span class="value">{{ $inventarisasi->cara_perolehan }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Tahun Beli</span>
                        <span class="value">{{ $inventarisasi->tahun_beli }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="label">Ukuran</span>
                        <span class="value">{{ $inventarisasi->ukuran }} {{ $inventarisasi->satuan }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-item">
                        <span class="label">Keadaan</span>
                        <span class="value">{{ $inventarisasi->keadaan }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-item">
                        <span class="label">Jumlah</span>
                        <span class="value">{{ $inventarisasi->jumlah }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-item">
                        <span class="label">Harga</span>
                        <span class="value">Rp {{ number_format($inventarisasi->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="detail-item">
                        <span class="label">Keterangan</span>
                        <span class="value">{{ $inventarisasi->keterangan }}</span>
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <a href="{{ route('inventarisasi.print', $inventarisasi->id) }}" class="btn btn-success">
                    <i class="bi bi-printer"></i> Cetak QR
                </a>
            </div>
        </div>
    </div>
@endsection