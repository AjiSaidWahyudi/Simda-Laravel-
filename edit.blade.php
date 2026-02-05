@extends('layouts.rumah')

@section('content')
<div class="card-custom mt-4">
    <h5 class="mb-3">Tambah Inventaris</h5>
    <form action="{{ route('inventarisasi.update', $inventarisasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <x-select label="Ruangan" name="kartu_ruang_id" :options="$ruangan->pluck('nama_ruangan','id')" :value="$inventarisasi->kartu_ruang_id" />
            <x-input label="Kode Barang" name="kode_barang" placeholder="Masukkan kode barang" :value="$inventarisasi->kode_barang" />
            <x-input label="Kode Register" name="kode_register" placeholder="Masukkan kode register" :value="$inventarisasi->kode_register" />
            <x-input label="Jenis Barang" name="jenis_barang" placeholder="Masukkan jenis barang" :value="$inventarisasi->jenis_barang" />
            <x-input label="Nama Pemegang" name="nama_pemegang" placeholder="Masukkan nama pemegang" :value="$inventarisasi->nama_pemegang" />
            <x-input label="Merek & Tipe" name="merek_tipe" placeholder="Masukkan merek dan tipe" :value="$inventarisasi->merek_tipe" />
            <x-input label="No. Seri" name="no_seri" placeholder="Masukkan nomor seri" :value="$inventarisasi->no_seri" />
            <x-input label="Bahan" name="bahan" placeholder="Masukkan bahan" :value="$inventarisasi->bahan" />
            <x-input label="Cara Perolehan" name="cara_perolehan" placeholder="Masukkan cara perolehan (beli, hibah, dll.)" :value="$inventarisasi->cara_perolehan" />
            <x-input label="Tahun Beli" name="tahun_beli" placeholder="Masukkan tahun beli" :value="$inventarisasi->tahun_beli" />
            <x-input label="Ukuran" name="ukuran" placeholder="Masukkan ukuran" :value="$inventarisasi->ukuran" />
            <x-input label="Satuan" name="satuan" placeholder="Masukkan satuan" :value="$inventarisasi->satuan" />
            <x-select label="Keadaan" name="keadaan" :options="['Baik' => 'Baik', 'Kurang Baik' => 'Kurang Baik', 'Rusak Berat' => 'Rusak Berat']" :value="$inventarisasi->keadaan" />
            <x-input label="Jumlah" name="jumlah" placeholder="Masukkan jumlah barang" :value="$inventarisasi->jumlah" />
            <x-input label="Harga" name="harga" placeholder="Masukkan harga (Rp)" :value="$inventarisasi->harga" />
            <x-textarea label="Keterangan" name="keterangan" :value="$inventarisasi->keterangan" />
            <div class="col-12">
                <label class="form-label">Foto Barang (maks. 4)</label>
                {{-- Input file asli disembunyikan agar tampilan rapi --}}
                <input type="file" id="image-input" name="gambar[]" accept="image/*" multiple style="display: none;">

                <div class="image-dropzone border rounded p-3 d-flex gap-2 flex-wrap mt-2">
                    {{-- Tombol tambah diletakkan di paling akhir --}}
                    <div class="add-image" style="width:80px;height:80px;border:1px dashed #aaa;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                        <span>+</span>
                    </div>
                </div>

                @error('gambar')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 text-end mt-3">
                <button type="reset" class="btn btn-light">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('admin_simda/js/previewImage.js') }}"></script>
<script>
    // Ambil data gambar dari relasi model GambarInv
    @if($inventarisasi->gambar_inv->count() > 0)
        const oldUrls = [
            @foreach($inventarisasi->gambar_inv as $item)
                "{{ asset('gambar_barang/' . $inventarisasi->id . '/' . $item->gambar) }}",
            @endforeach
        ];
        initExistingImages(oldUrls);
    @endif
</script>
@endsection