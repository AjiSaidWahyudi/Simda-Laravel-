

<?php $__env->startSection('content'); ?>
    <div class="card-custom mt-4">
        <div class="table-header">
            <h5>Daftar Inventarisasi</h5>
            <a href="<?php echo e(route('inventarisasi.create')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="mb-3">
    <form method="GET" action="<?php echo e(route('inventarisasi.index')); ?>">
        <div class="row g-2 align-items-end">

            <div class="col-md-3">
                <label class="form-label">Kondisi Barang</label>
                <select name="keadaan" class="form-select">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik"
                        <?php echo e(request('keadaan') == 'Baik' ? 'selected' : ''); ?>>
                        Baik
                    </option>
                    <option value="Kurang Baik"
                        <?php echo e(request('keadaan') == 'Kurang Baik' ? 'selected' : ''); ?>>
                        Kurang Baik
                    </option>
                    <option value="Rusak Berat"
                        <?php echo e(request('keadaan') == 'Rusak Berat' ? 'selected' : ''); ?>>
                        Rusak Berat
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            <?php if(request()->has('keadaan')): ?>
            <div class="col-md-3">
                <a href="<?php echo e(route('inventarisasi.index')); ?>"
                   class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
            <?php endif; ?>

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
                    <?php $__currentLoopData = $inventarisasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($inventarisasi->firstItem() + $index); ?></td>
                        <td><?php echo e($inv->kode_barang); ?> <br> <?php echo e($inv->kode_register); ?></td>
                        <td><?php echo e($inv->jenis_barang); ?> <br> <?php echo e($inv->merek_tipe); ?></td>
                        <td><?php echo e($inv->no_seri); ?></td>
                        <td><?php echo e($inv->bahan); ?></td>
                        <td><?php echo e($inv->cara_perolehan); ?> <br> <?php echo e($inv->tahun_beli); ?></td>
                        <td><?php echo e($inv->ukuran); ?> <?php echo e($inv->satuan); ?></td>
                        <td>
                            <?php if($inv->keadaan === 'Baik'): ?>
                                <span class="badge bg-success">Baik</span>
                            <?php elseif($inv->keadaan === 'Kurang Baik'): ?>
                                <span class="badge bg-warning text-dark">Kurang Baik</span>
                            <?php elseif($inv->keadaan === 'Rusak Berat'): ?>
                                <span class="badge bg-danger">Rusak Berat</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?php echo e($inv->keadaan); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>Jumlah: <?php echo e($inv->jumlah); ?> <br> Rp <?php echo e(number_format($inv->harga, 0, ',', '.')); ?></td>
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
                        Menampilkan <?php echo e($inventarisasi->firstItem()); ?> sampai <?php echo e($inventarisasi->lastItem()); ?>

                        dari <?php echo e($inventarisasi->total()); ?> data
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                        <?php echo e($inventarisasi->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.rumah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project_aji\laravel\simda\resources\views/inventarisasi/index.blade.php ENDPATH**/ ?>