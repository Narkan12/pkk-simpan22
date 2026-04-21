

<?php $__env->startSection('title', 'Departemen'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Departemen</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahDepartemen')">
            <i class="bi bi-plus"></i> Tambah Departemen
        </button>
    </div>

    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-departemen" placeholder="Cari departemen...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-departemen">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA DEPARTEMEN</th>
                    <th>KEPALA DEPARTEMEN</th>
                    <th>JUMLAH PEGAWAI</th>
                    <th>LOKASI</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departemen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($departemen->kode_departemen); ?></td>
                    <td><span class="status-departemen"><?php echo e($departemen->nama_departemen); ?></span></td>
                    <td><?php echo e($departemen->kepala_departemen ?? '-'); ?></td>
                    <td>-</td>
                    <td><?php echo e($departemen->lokasi ?? '-'); ?></td>
                    <td>
                        <button class="btn-view" onclick="openModalEditGeneric('formEditDepartemen', 'modalEditDepartemen', {
                            action: '/departemen/<?php echo e($departemen->id); ?>',
                            editKodeDept: '<?php echo e($departemen->kode_departemen); ?>',
                            editNamaDept: '<?php echo e($departemen->nama_departemen); ?>',
                            editKepalaDept: '<?php echo e($departemen->kepala_departemen); ?>',
                            editLokasiDept: '<?php echo e($departemen->lokasi); ?>'
                        })"><i class="bi bi-pencil-fill"></i></button>

                        <button class="btn-delete" onclick="openModalHapusGeneric(
                            'formHapusDepartemen',
                            'modalHapusDepartemen',
                            '/departemen/<?php echo e($departemen->id); ?>',
                            '<?php echo e($departemen->nama_departemen); ?>',
                            '<?php echo e($departemen->kode_departemen); ?>'
                        )"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data departemen.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginalf8d608faed9aa851f81104aaa64afbc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d608faed9aa851f81104aaa64afbc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-departemen','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-departemen'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d608faed9aa851f81104aaa64afbc7)): ?>
<?php $attributes = $__attributesOriginalf8d608faed9aa851f81104aaa64afbc7; ?>
<?php unset($__attributesOriginalf8d608faed9aa851f81104aaa64afbc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d608faed9aa851f81104aaa64afbc7)): ?>
<?php $component = $__componentOriginalf8d608faed9aa851f81104aaa64afbc7; ?>
<?php unset($__componentOriginalf8d608faed9aa851f81104aaa64afbc7); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\departemen.blade.php ENDPATH**/ ?>