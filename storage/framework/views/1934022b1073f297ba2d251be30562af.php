<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAN - Login</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/x-icon">
</head>

<body class="login-body">

    <div class="login-card zoom-in">

        
        <div class="login-left">

            <h1 class="login-title">SELAMAT DATANG!</h1>
            <p class="login-subtitle">Silahkan masukan data anda</p>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                
                <div class="mb-4">
                    <label for="email" class="field-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="bi bi-person-fill"></i></span>
                        <input type="email" id="email" name="email" placeholder="Masukan Email Anda"
                            class="input-field" value="<?php echo e(request('email')); ?>" required>
                    </div>
                </div>

                
                <div class="mb-4">
                    <label for="password" class="field-label">Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="bi bi-key"></i></span>
                        <input type="password" id="password" name="password" placeholder="Masukan Password Anda"
                            class="input-field" required>
                        <button type="button" id="togglePassword" class="toggle-btn">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
                    <label class="login-remember">
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                    <a href="#" class="forgot-link">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="btn-login">MASUK</button>

            </form>
        </div>

        
        <div class="login-right">
            <div class="brand-circle"></div>
            <div class="text-center relative z-10">
                <h2 class="brand-title">SIMPAN</h2>
                <p class="brand-subtitle">SISTEM INFORMASI KEPEGAWAIAN</p>
                <div class="flex justify-center">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="brand-logo">
                </div>
                <p class="brand-tagline">Your Privacy is Safe!</p>
            </div>
        </div>

    </div>

    <div id="loginData"
        data-success="<?php echo e(session('success')); ?>"
        data-error="<?php echo e(session('error')); ?>"
        class="hidden">
    </div>

    <?php if (isset($component)) { $__componentOriginalbe6d4166c91de8c6dfa6fb310acb2eb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe6d4166c91de8c6dfa6fb310acb2eb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-login','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-login'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe6d4166c91de8c6dfa6fb310acb2eb9)): ?>
<?php $attributes = $__attributesOriginalbe6d4166c91de8c6dfa6fb310acb2eb9; ?>
<?php unset($__attributesOriginalbe6d4166c91de8c6dfa6fb310acb2eb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe6d4166c91de8c6dfa6fb310acb2eb9)): ?>
<?php $component = $__componentOriginalbe6d4166c91de8c6dfa6fb310acb2eb9; ?>
<?php unset($__componentOriginalbe6d4166c91de8c6dfa6fb310acb2eb9); ?>
<?php endif; ?>

    
    <?php echo $__env->make('components.notifikasi-toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\auth\login.blade.php ENDPATH**/ ?>