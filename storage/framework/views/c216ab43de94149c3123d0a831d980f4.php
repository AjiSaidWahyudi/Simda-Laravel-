<nav class="navbar-custom">
    <div class="navbar-left page-info">
        <h4 class="page-title mb-0"><?php echo e($pageTitle ?? 'Dashboard'); ?></h4>
        <nav class="breadcrumb-custom">
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($item['url'])): ?>
                    <a href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
                    <span>/</span>
                <?php else: ?>
                    <span class="active"><?php echo e($item['label']); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>
    <div class="navbar-right">
        <button class="icon-btn">
            <i class="bi bi-bell"></i>
        </button>
        <div class="user-dropdown">
            <div class="user-trigger" id="userToggle">
                <img src="https://i.pravatar.cc/40" alt="User">
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-menu-custom" id="userMenu">
                <div class="dropdown-header">
                    <div class="user-name"><?php echo e($user->name); ?></div>
                    <div class="user-email"><?php echo e($user->email); ?></div>
                </div>
                <a href="<?php echo e(route('settings')); ?>" class="dropdown-item">
                    <i class="bi bi-person"></i> Profil
                </a>
                <a href="<?php echo e(route('kelola_akun')); ?>" class="dropdown-item">
                    <i class="bi bi-person"></i> Kelola Akun
                </a>
                <a href="<?php echo e(route('kelola_akses')); ?>" class="dropdown-item">
                    <i class="bi bi-person"></i> Kelola Akses
                </a>
                <div class="dropdown-divider"></div>
                <form action="<?php echo e(route('logout')); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav><?php /**PATH D:\project_aji\laravel\simda\resources\views/layouts/parts/navbar.blade.php ENDPATH**/ ?>