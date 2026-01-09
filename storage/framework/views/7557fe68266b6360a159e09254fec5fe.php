<?php $__env->startSection('content'); ?>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card stat-primary">
                <div class="stat-header">
                    <span class="stat-title">Total Barang</span>
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo e(number_format($totalBarang, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-success">
                <div class="stat-header">
                    <span class="stat-title">Barang Baik</span>
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo e(number_format($barangBaik, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-warning">
                <div class="stat-header">
                    <span class="stat-title">Rusak Ringan</span>
                    <div class="stat-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo e(number_format($rusakRingan, 0, ',', '.')); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card stat-danger">
                <div class="stat-header">
                    <span class="stat-title">Rusak Berat</span>
                    <div class="stat-icon">
                    <i class="bi bi-x-circle"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo e(number_format($rusakBerat, 0, ',', '.')); ?></div>
            </div>
        </div>
    </div>
    <div class="card-custom mb-4">
        <div class="search-header">
            <h5 class="mb-0">Pencarian Inventaris</h5>
            <form action="<?php echo e(route('home')); ?>" method="get">
                <div class="search-form-inline">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama barang..." value="<?php echo e(isset($keyword) ? $keyword : ''); ?>" required>
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="table-responsive mt-3">
            <?php if(isset($results)): ?>    
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
                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($results->firstItem() + $index); ?></td>
                            <td><?php echo e($inv->kode_barang); ?> <br> <?php echo e($inv->kode_register); ?></td>
                            <td><?php echo e($inv->jenis_barang); ?> <br> <?php echo e($inv->merek_tipe); ?></td>
                            <td><?php echo e($inv->no_seri); ?></td>
                            <td><?php echo e($inv->bahan); ?></td>
                            <td><?php echo e($inv->cara_perolehan); ?> <br> <?php echo e($inv->tahun_beli); ?></td>
                            <td><?php echo e($inv->ukuran); ?> <?php echo e($inv->satuan); ?></td>
                            <td><?php echo e($inv->keadaan); ?></td>
                            <td>Jumlah: <?php echo e($inv->jumlah); ?> <br>
                                Rp <?php echo e(number_format($inv->harga, 0, ',', '.')); ?></td>
                            <td>
                                <?php if($inv->qr_code): ?>
                                    <img src="<?php echo e(asset('qr_codes/'.$inv->qr_code)); ?>" width="70">
                                <?php else: ?>
                                    <span class="text-danger">QR belum ada</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?php echo e(route('inventarisasi.destroy', $inv->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="<?php echo e(route('inventarisasi.show', $inv->id)); ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                                    <a href="<?php echo e(route('inventarisasi.edit', $inv->id)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="table-footer mt-3">
                <div class="row align-items-center mt-4">
                    <div class="col-md-6 mb-2 mb-md-0 text-muted">
                        Menampilkan <?php echo e($results->firstItem()); ?> sampai <?php echo e($results->lastItem()); ?>

                        dari <?php echo e($results->total()); ?> data
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                        <?php echo e($results->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Masukkan nama barang atau ruangan untuk melakukan pencarian
                    </td>
                </tr>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.rumah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project_aji\laravel\simda\resources\views/home.blade.php ENDPATH**/ ?>