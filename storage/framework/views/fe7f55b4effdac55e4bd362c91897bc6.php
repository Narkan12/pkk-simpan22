
<aside id="sidebar" class="sidebar" data-expanded="true">

    
    <div class="sidebar-logo">
        <div class="sidebar-logo-circle">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo">
        </div>
        <div class="sidebar-text sidebar-logo-text">
            <div class="sidebar-logo-name">SIMPAN</div>
            <div class="sidebar-logo-role">Panel Admin</div>
        </div>
    </div>

    
    <nav class="sidebar-nav">

        <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('dashboard')).'','icon' => 'bi-house','route' => 'dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('dashboard')).'','icon' => 'bi-house','route' => 'dashboard']); ?>Beranda <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('data-pegawai')).'','icon' => 'bi-people','route' => 'data-pegawai']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('data-pegawai')).'','icon' => 'bi-people','route' => 'data-pegawai']); ?>Data Pegawai <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>

        
        <?php $dmActive = request()->routeIs(['jabatan','departemen','status','golongan','pendidikan','komponen-gaji']); ?>
        <button onclick="toggleDropdown('menuDataMaster', this)" class="nav-item w-full <?php echo e($dmActive ? 'active' : ''); ?>">
            <i class="bi bi-database nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Data Master</span>
            <i class="bi bi-chevron-<?php echo e($dmActive ? 'up' : 'down'); ?> sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuDataMaster" class="<?php echo e($dmActive ? '' : 'hidden'); ?> sidebar-dropdown-panel">
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('jabatan')).'','icon' => 'bi-briefcase','route' => 'jabatan','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('jabatan')).'','icon' => 'bi-briefcase','route' => 'jabatan','dropdown' => true]); ?>Jabatan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('departemen')).'','icon' => 'bi-diagram-3','route' => 'departemen','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('departemen')).'','icon' => 'bi-diagram-3','route' => 'departemen','dropdown' => true]); ?>Departemen <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('status')).'','icon' => 'bi-toggle-on','route' => 'status','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('status')).'','icon' => 'bi-toggle-on','route' => 'status','dropdown' => true]); ?>Status <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('golongan')).'','icon' => 'bi-layers','route' => 'golongan','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('golongan')).'','icon' => 'bi-layers','route' => 'golongan','dropdown' => true]); ?>Golongan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('pendidikan')).'','icon' => 'bi-mortarboard','route' => 'pendidikan','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('pendidikan')).'','icon' => 'bi-mortarboard','route' => 'pendidikan','dropdown' => true]); ?>Pendidikan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('komponen-gaji')).'','icon' => 'bi-coin','route' => 'komponen-gaji','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('komponen-gaji')).'','icon' => 'bi-coin','route' => 'komponen-gaji','dropdown' => true]); ?>Komponen Gaji <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
        </div>

        
        <?php $opActive = request()->routeIs(['absensi','manajemen-cuti','manajemen-gaji']); ?>
        <button onclick="toggleDropdown('menuOperasional', this)" class="nav-item w-full <?php echo e($opActive ? 'active' : ''); ?>">
            <i class="bi bi-gear nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Operasional</span>
            <i class="bi bi-chevron-<?php echo e($opActive ? 'up' : 'down'); ?> sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuOperasional" class="<?php echo e($opActive ? '' : 'hidden'); ?> sidebar-dropdown-panel">
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('absensi')).'','icon' => 'bi-calendar-check','route' => 'absensi','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('absensi')).'','icon' => 'bi-calendar-check','route' => 'absensi','dropdown' => true]); ?>Absensi <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('manajemen-cuti')).'','icon' => 'bi-file-earmark-text','route' => 'manajemen-cuti','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('manajemen-cuti')).'','icon' => 'bi-file-earmark-text','route' => 'manajemen-cuti','dropdown' => true]); ?>Cuti <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('manajemen-gaji')).'','icon' => 'bi-cash-stack','route' => 'manajemen-gaji','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('manajemen-gaji')).'','icon' => 'bi-cash-stack','route' => 'manajemen-gaji','dropdown' => true]); ?>Gaji <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
        </div>

        
        <?php $lapActive = request()->routeIs(['ekspor-data','laporan-pegawai','laporan-gaji','laporan-cuti','laporan-jabatan']); ?>
        <button onclick="toggleDropdown('menuLaporan', this)" class="nav-item w-full <?php echo e($lapActive ? 'active' : ''); ?>">
            <i class="bi bi-bar-chart nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Laporan</span>
            <i class="bi bi-chevron-<?php echo e($lapActive ? 'up' : 'down'); ?> sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuLaporan" class="<?php echo e($lapActive ? '' : 'hidden'); ?> sidebar-dropdown-panel">
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('ekspor-data')).'','icon' => 'bi-download','route' => 'ekspor-data','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('ekspor-data')).'','icon' => 'bi-download','route' => 'ekspor-data','dropdown' => true]); ?>Ekspor Data <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('laporan-pegawai')).'','icon' => 'bi-person-lines-fill','route' => 'laporan-pegawai','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('laporan-pegawai')).'','icon' => 'bi-person-lines-fill','route' => 'laporan-pegawai','dropdown' => true]); ?>Laporan Pegawai <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('laporan-gaji')).'','icon' => 'bi-cash-coin','route' => 'laporan-gaji','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('laporan-gaji')).'','icon' => 'bi-cash-coin','route' => 'laporan-gaji','dropdown' => true]); ?>Laporan Gaji <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('laporan-cuti')).'','icon' => 'bi-calendar2-minus','route' => 'laporan-cuti','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('laporan-cuti')).'','icon' => 'bi-calendar2-minus','route' => 'laporan-cuti','dropdown' => true]); ?>Laporan Cuti <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-active','data' => ['href' => ''.e(route('laporan-jabatan')).'','icon' => 'bi-briefcase','route' => 'laporan-jabatan','dropdown' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar-active'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('laporan-jabatan')).'','icon' => 'bi-briefcase','route' => 'laporan-jabatan','dropdown' => true]); ?>Laporan Jabatan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $attributes = $__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__attributesOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c)): ?>
<?php $component = $__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c; ?>
<?php unset($__componentOriginal47eafdf25f4cd29123a4a39fff9b6a0c); ?>
<?php endif; ?>
        </div>

    </nav>

    
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">A</div>
        <div class="sidebar-text sidebar-user-info">
            <div class="sidebar-user-name"><?php echo e(auth()->user()->username ?? 'Nama Pengguna'); ?></div>
            <div class="sidebar-user-email"><?php echo e(auth()->user()->email ?? 'pengguna@email.com'); ?></div>
        </div>
    </div>

    
    <button type="button" onclick="openLogoutModal()" class="nav-item" style="border-top:1px solid var(--green-medium);flex-shrink:0;width:100%;text-align:left;color:#C62828;">
        <i class="bi bi-box-arrow-right nav-icon"></i>
        <span class="sidebar-text" style="margin-left:0.75rem;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Keluar</span>
    </button>

</aside>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\sidebar.blade.php ENDPATH**/ ?>