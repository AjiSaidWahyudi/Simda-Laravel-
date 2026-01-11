<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        h2 {
            margin-bottom: 10px;
            text-align: center;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .content {
            width: 100%;
        }

        .left {
            width: 65%;
            float: left;
        }

        .right {
            width: 30%;
            float: right;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 0;
            vertical-align: top;
        }

        td.label {
            width: 35%;
            font-weight: bold;
        }

        .image-box {
            border: 1px solid #000;
            padding: 6px;
            margin-bottom: 10px;
        }

        .image-box img {
            max-width: 100%;
            max-height: 180px;
        }

        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>DETAIL INVENTARIS BARANG</h2>
        <div style="text-align:center;">
            Nomor Inventaris: <strong>#{{ $inv->id }}</strong>
        </div>
    </div>

    <div class="content">
        {{-- DATA --}}
        <div class="left">
            <table>
                <tr><td class="label">Ruang</td><td>: {{ $inv->kartu_ruang->nama_ruangan }}</td></tr>
                <tr><td class="label">Kode Barang</td><td>: {{ $inv->kode_barang }}</td></tr>
                <tr><td class="label">Kode Register</td><td>: {{ $inv->kode_register }}</td></tr>
                <tr><td class="label">Jenis Barang</td><td>: {{ $inv->jenis_barang }}</td></tr>
                <tr><td class="label">Merek / Tipe</td><td>: {{ $inv->merek_tipe }}</td></tr>
                <tr><td class="label">No. Seri</td><td>: {{ $inv->no_seri }}</td></tr>
                <tr><td class="label">Bahan</td><td>: {{ $inv->bahan }}</td></tr>
                <tr><td class="label">Cara Perolehan</td><td>: {{ $inv->cara_perolehan }}</td></tr>
                <tr><td class="label">Tahun Beli</td><td>: {{ $inv->tahun_beli }}</td></tr>
                <tr><td class="label">Ukuran</td><td>: {{ $inv->ukuran }} {{ $inv->satuan }}</td></tr>
                <tr><td class="label">Keadaan</td><td>: {{ $inv->keadaan }}</td></tr>
                <tr><td class="label">Jumlah</td><td>: {{ $inv->jumlah }}</td></tr>
                <tr><td class="label">Harga</td><td>: Rp {{ number_format($inv->harga,0,',','.') }}</td></tr>
                <tr><td class="label">Keterangan</td><td>: {{ $inv->keterangan }}</td></tr>
            </table>
        </div>

        {{-- GAMBAR --}}
        <div class="right">
            <div class="image-box">
                @if($inv->gambar_inv->count())
                    @foreach($inv->gambar_inv as $img)
                        <img
                            src="{{ public_path('gambar_barang/'.$img->inv_id.'/'.$img->gambar) }}"
                            style="width:48%;height:80px;object-fit:cover;margin:2px;"
                        >
                    @endforeach
                @else
                    <div style="font-style:italic; color:#555;">
                        Foto tidak tersedia
                    </div>
                @endif
            </div>
            <small>Foto Barang</small>
        </div>


        <div class="clearfix"></div>
    </div>

</body>
</html>
