
<header id="topHeader" class="top-header">

    
    <div class="header-left">
        <button onclick="toggleSidebar()" class="header-toggle-btn">
            <i class="bi bi-list"></i>
        </button>
        <div class="header-breadcrumb">
            <span class="header-breadcrumb-sub">Dashboard / <?php echo e($slot); ?></span>
            <h2 class="header-breadcrumb-title"><?php echo e($slot); ?></h2>
        </div>
    </div>

    
    <div class="header-right">
        <span class="header-clock">
            <i class="bi bi-clock" style="margin-right:4px;"></i>
            <span id="currentTime">00:00:00</span>
        </span>
    </div>

</header>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\header.blade.php ENDPATH**/ ?>