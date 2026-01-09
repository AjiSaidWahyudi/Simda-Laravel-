<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="<?php echo e(asset('admin_simda/logo/logo_white.png')); ?>" alt="Logo SIMDA">
        <span>SIMDA</span>
    </div>
    <ul class="menu">
        <li class="menu-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('home')); ?>">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
        </li>
        <li class="menu-item <?php echo e(request()->routeIs('kir.index') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('kir.index')); ?>">
                <i class="bi bi-building"></i>Ruangan
            </a>
        </li>
        <li class="menu-item <?php echo e(request()->routeIs('inventarisasi.index') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('inventarisasi.index')); ?>">
                <i class="bi bi-box"></i>Inventarisasi
            </a>
        </li>
        <li class="menu-item <?php echo e(request()->routeIs('laporan.index') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('laporan.index')); ?>">
                <i class="bi bi-file-earmark-text"></i>Laporan
            </a>
        </li>
    </ul>
</aside><?php /**PATH D:\project_aji\laravel\simda\resources\views/layouts/parts/sidebar.blade.php ENDPATH**/ ?>