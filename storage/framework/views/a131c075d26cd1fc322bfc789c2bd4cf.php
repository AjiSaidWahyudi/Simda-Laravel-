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
            Nomor Inventaris: <strong>#<?php echo e($inv->id); ?></strong>
        </div>
    </div>

    <div class="content">
        
        <div class="left">
            <table>
                <tr><td class="label">Ruang</td><td>: <?php echo e($inv->kartu_ruang->nama_ruangan); ?></td></tr>
                <tr><td class="label">Kode Barang</td><td>: <?php echo e($inv->kode_barang); ?></td></tr>
                <tr><td class="label">Kode Register</td><td>: <?php echo e($inv->kode_register); ?></td></tr>
                <tr><td class="label">Jenis Barang</td><td>: <?php echo e($inv->jenis_barang); ?></td></tr>
                <tr><td class="label">Merek / Tipe</td><td>: <?php echo e($inv->merek_tipe); ?></td></tr>
                <tr><td class="label">No. Seri</td><td>: <?php echo e($inv->no_seri); ?></td></tr>
                <tr><td class="label">Bahan</td><td>: <?php echo e($inv->bahan); ?></td></tr>
                <tr><td class="label">Cara Perolehan</td><td>: <?php echo e($inv->cara_perolehan); ?></td></tr>
                <tr><td class="label">Tahun Beli</td><td>: <?php echo e($inv->tahun_beli); ?></td></tr>
                <tr><td class="label">Ukuran</td><td>: <?php echo e($inv->ukuran); ?> <?php echo e($inv->satuan); ?></td></tr>
                <tr><td class="label">Keadaan</td><td>: <?php echo e($inv->keadaan); ?></td></tr>
                <tr><td class="label">Jumlah</td><td>: <?php echo e($inv->jumlah); ?></td></tr>
                <tr><td class="label">Harga</td><td>: Rp <?php echo e(number_format($inv->harga,0,',','.')); ?></td></tr>
                <tr><td class="label">Keterangan</td><td>: <?php echo e($inv->keterangan); ?></td></tr>
            </table>
        </div>

        
        <div class="right">
            <div class="image-box">
                <?php if($inv->gambar && file_exists(public_path('gambar_barang/'.$inv->gambar))): ?>
                    <img src="<?php echo e(public_path('gambar_barang/'.$inv->gambar)); ?>" alt="Foto Barang">
                <?php else: ?>
                    <div style="font-style:italic; color:#555;">
                        Foto tidak tersedia
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <small>Foto Barang</small>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

</body>
</html>
<?php /**PATH D:\project_aji\laravel\simda\resources\views/inventarisasi/pdf.blade.php ENDPATH**/ ?>