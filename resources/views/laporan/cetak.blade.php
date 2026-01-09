<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Inventarisasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        .table th {
            background: #f2f2f2;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2, .header h4 {
            margin: 0;
            padding: 0;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <table style="width:100%; border-bottom:3px solid #000; padding-bottom:10px;">
        <tr>
            <td style="width: 80px; text-align:center;">
                <img src="{{ public_path('logo/pemkot.png') }}" width="70">
            </td>
            <td style="text-align:center;">
                <div style="font-size:16px; font-weight:bold;">PEMERINTAH KOTA SAMARINDA</div>
                <div style="font-size:18px; font-weight:bold;">KARTU INVENTARIS RUANGAN</div>
            </td>
            <td style="width:80px;"></td>
        </tr>
    </table>

    <br>

    <div class="header">
        <table style="width:100%; border:none; padding-bottom:10px;">
            <tr>
                <td style="width: 20%; font-weight:bold">Provinsi</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Kalimantan Timur</td>
            </tr>
            <tr>
                <td style="width: 20%; font-weight:bold">Kabupaten / Kota</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Samarinda</td>
            </tr>
            <tr>
                <td style="width: 20%; font-weight:bold">Bidang</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Bidang Komunikasi, Informasi dan Dokumentasi</td>
            </tr>
            <tr>
                <td style="width: 20%; font-weight:bold">Unit Organisasi</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Dinas Komunikasi Dan Informatika</td>
            </tr>
            <tr>
                <td style="width: 20%; font-weight:bold">Sub Unit Organisasi</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Dinas Komunikasi Dan Informatika</td>
            </tr>
            <tr>
                <td style="width: 20%; font-weight:bold">UPB</td>
                <td style="width: 5%; font-weight:bold">:</td>
                <td>Dinas Komunikasi Dan Informatika</td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Kode Barang</th>
                <th>Register</th>
                <th>Nama / Jenis Barang</th>
                <th>Merek / Tipe</th>
                <th>No. Sertifikat / Pabrik / Chasis / Mesin</th>
                <th>Bahan</th>
                <th>Asal/Cara Perolehan Barang</th>
                <th>Tahun Pembelian</th>
                <th>Ukuran Barang / Konstruksi (P, S, D)</th>
                <th>Satuan</th>
                <th>Keadaan Barang (B/KB/RB)</th>
                <th>Jumlah Barang</th>
                <th>Harga</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventarisasi as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->kode_register }}</td>
                <td>{{ $item->jenis_barang }}</td>
                <td>{{ $item->merek_tipe }}</td>
                <td>{{ $item->no_seri }}</td>
                <td>{{ $item->bahan }}</td>
                <td>{{ $item->cara_perolehan }}</td>
                <td>{{ $item->tahun_beli }}</td>
                <td>{{ $item->ukuran }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->keadaan }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center">Tidak ada data untuk bulan ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @php
        $total_harga = $inventarisasi->sum('harga');
    @endphp

    <br>

    <table style="width: 40%; margin-top:10px; border-collapse: collapse;">
        <tr>
            <td style="border:1px solid #333; padding:6px; font-weight:bold;">TOTAL HARGA</td>
            <td style="border:1px solid #333; padding:6px; text-align:right;">
                Rp {{ number_format($total_harga, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <br><br>

    <table style="width:100%; margin-top:30px;">
        <tr>
            <td style="text-align:center; width:50%;">
                Mengetahui, <br>
                Kepala Dinas Komunikasi dan Informatika <br><br><br><br>
                <strong>__________________________</strong><br>
                NIP. __________________________
            </td>

            <td style="text-align:center; width:50%;">
                Samarinda, {{ now()->translatedFormat('d F Y') }} <br>
                Pengadministrasi Sarana dan Prasarana <br><br><br><br>
                <strong>__________________________</strong><br>
                NIP. __________________________
            </td>
        </tr>
    </table>

    <br>

    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
