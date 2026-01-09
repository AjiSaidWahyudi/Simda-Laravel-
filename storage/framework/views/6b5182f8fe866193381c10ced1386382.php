

<?php $__env->startSection('content'); ?>
    <div class="card-custom mt-4">
        <div class="table-header">
            <h5>Daftar Ruangan</h5>
            <a href="<?php echo e(route('kir.create')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $kartu_ruang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($kartu_ruang->firstItem() + $index); ?></td>
                        <td><?php echo e($kir->kode_ruangan); ?></td>
                        <td><?php echo e($kir->nama_ruangan); ?></td>
                        <td>
                            <form action="<?php echo e(route('kir.destroy', $kir->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <a href="<?php echo e(route('kir.edit', $kir->id)); ?>" class="btn btn-sm btn-outline-warning">Edit</a>
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
                        Menampilkan <?php echo e($kartu_ruang->firstItem()); ?> sampai <?php echo e($kartu_ruang->lastItem()); ?>

                        dari <?php echo e($kartu_ruang->total()); ?> data
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                        <?php echo e($kartu_ruang->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.rumah', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project_aji\laravel\simda\resources\views/kir/index.blade.php ENDPATH**/ ?>