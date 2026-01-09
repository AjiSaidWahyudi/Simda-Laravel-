@extends('layouts.rumah')

@section('content')
<div class="card-custom mt-4">
    <h5 class="mb-3">Tambah Inventaris</h5>
    <form action="{{route('inventarisasi.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <x-select label="Ruangan" name="kartu_ruang_id" :options="$ruangan->pluck('nama_ruangan','id')" />
            <x-input label="Kode Barang" name="kode_barang" placeholder="Masukkan kode barang" />
            <x-input label="Kode Register" name="kode_register" placeholder="Masukkan kode register" />
            <x-input label="Jenis Barang" name="jenis_barang" placeholder="Masukkan jenis barang" />
            <x-input label="Nama Pemegang" name="nama_pemegang" placeholder="Masukkan nama pemegang" />
            <x-input label="Merek & Tipe" name="merek_tipe" placeholder="Masukkan merek dan tipe" />
            <x-input label="No. Seri" name="no_seri" placeholder="Masukkan nomor seri" />
            <x-input label="Bahan" name="bahan" placeholder="Masukkan bahan" />
            <x-input label="Cara Perolehan" name="cara_perolehan" placeholder="Masukkan cara perolehan (beli, hibah, dll.)" />
            <x-input label="Tahun Beli" name="tahun_beli" placeholder="Masukkan tahun beli" />
            <x-input label="Ukuran" name="ukuran" placeholder="Masukkan ukuran" />
            <x-input label="Satuan" name="satuan" placeholder="Masukkan satuan" />
            <x-select label="Keadaan" name="keadaan" :options="['Baik' => 'Baik', 'Kurang Baik' => 'Kurang Baik', 'Rusak Berat' => 'Rusak Berat']" />
            <x-input label="Jumlah" name="jumlah" placeholder="Masukkan jumlah barang" />
            <x-input label="Harga" name="harga" placeholder="Masukkan harga (Rp)" />
            <x-textarea label="Keterangan" name="keterangan" placeholder="Tambahkan keterangan tambahan..." />
            <x-image-picker name="gambar[]" />
            <div class="col-12 text-end mt-3">
                <button type="reset" class="btn btn-light">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection