<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>QR Code</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: sans-serif;
        }

        .qr-wrapper {
            margin-top: 20px;
        }

        .qr-wrapper img {
            width: 120px;  /* ukuran QR kecil */
            height: auto;
        }

        .kode-text {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="qr-wrapper">
        <?php if($inventarisasi->qr_base64): ?>
            <img src="<?php echo e($inventarisasi->qr_base64); ?>" alt="QR Code">
        <?php else: ?>
            <p>QR tidak ditemukan</p>
        <?php endif; ?>

        <!-- kalau mau info kecil di bawah QR -->
        <div class="kode-text">
            <?php echo e($inventarisasi->kode_barang); ?> - <?php echo e($inventarisasi->kode_register); ?>

        </div>
    </div>

</body>
</html>
<?php /**PATH D:\project_aji\laravel\simda\resources\views/inventarisasi/print.blade.php ENDPATH**/ ?>