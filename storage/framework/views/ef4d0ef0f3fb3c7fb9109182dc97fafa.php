<!DOCTYPE html>
<html lang="id">
    <?php echo $__env->make('layouts.parts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <body>
        <div class="app-wrapper">
            <?php echo $__env->make('layouts.parts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <main class="main">
                <?php echo $__env->make('layouts.parts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <section class="content">
                    <?php echo $__env->yieldContent('content'); ?>
                </section>
                <footer class="footer">
                    © 2025 <strong>SIMDA Barang</strong> – Pemerintah Kota Samarinda.  
                    All rights reserved.
                </footer>
            </main>
        </div>
        <?php echo $__env->make('layouts.parts.script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </body>
</html><?php /**PATH D:\project_aji\laravel\simda\resources\views/layouts/rumah.blade.php ENDPATH**/ ?>