<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="/js/app.js" defer></script>
</head>

<body class="layout-pegawai-body">

    <!-- Navbar -->
    <nav class="pegawai-navbar">

    <!-- KIRI: Logo + Nama -->
    <div class="d-flex align-center" style="gap:0.5rem;">
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="" style="width:32px;">
        <span class="text-white font-bold tracking-widest" style="font-size:0.875rem;letter-spacing:0.1em;font-weight:700;color:#fff;">
            SIMPAN
        </span>
    </div>

    
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="nav-item" style="border-top:1px solid #1a1a1a;flex-shrink:0;">
            <i class="bi bi-box-arrow-right nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;">Keluar</span>
        </button>
    </form>

</nav>

    <!-- Content -->
    <main class="pegawai-main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->yieldContent('modal'); ?>

    
    <?php echo $__env->make('components.notifikasi-toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\layouts\layout-pegawai.blade.php ENDPATH**/ ?>