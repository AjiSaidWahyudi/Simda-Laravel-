

<?php $__env->startSection('content'); ?>
    <div class="card-custom">
        <div class="table-header mb-3">
            <h5>
                <i class="bi bi-file-earmark-text"></i>
                Cetak Laporan Inventaris
            </h5>
        </div>
        <form method="GET" action="<?php echo e(route('laporan.cetak')); ?>">
            <div class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">Jenis Barang</label>
                    <select name="kartu_ruang_id" class="form-select" required>
                        <option value="">Pilih Ruangan</option>
                        <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($r->id); ?>">
                                <?php echo e($r->nama_ruangan); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </button>
                </div>
            </div>
        </form>

        <?php if(request()->has('jenis_barang') && isset($qr)): ?>
            <hr>

            <!-- INFO -->
            <div class="alert alert-info mt-3">
                <?php if($jenis_barang): ?>
                    Scan QR berikut untuk membuka
                    <strong>laporan jenis barang: <?php echo e($jenis_barang); ?></strong>
                <?php else: ?>
                    Scan QR berikut untuk membuka
                    <strong>laporan seluruh data inventarisasi</strong>
                <?php endif; ?>
            </div>

            <!-- QR + ACTION -->
            <div class="text-center mt-3">
                <div class="qr-wrapper mb-3">
                    <?php echo $qr; ?>

                </div>

                <a href="<?php echo e($url); ?>"
                   target="_blank"
                   class="btn btn-primary">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Buka PDF
                </a>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.rumah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project_aji\laravel\simda\resources\views/laporan/index.blade.php ENDPATH**/ ?>