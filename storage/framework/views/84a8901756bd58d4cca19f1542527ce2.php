

<?php $__env->startSection('title', 'Golongan'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Golongan</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahGolongan')">
            <i class="bi bi-plus"></i> Tambah Golongan
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-golongan" placeholder="Cari golongan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-golongan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA GOLONGAN</th>
                    <th>PANGKAT</th>
                    <th>RUANG</th>
                    <th>ESELON</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $golongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($golongan->kode_golongan); ?></td>
                        <td class="font-semibold" style="color:#e6edf3;"><?php echo e($golongan->nama_golongan); ?></td>
                        <td><?php echo e($golongan->pangkat); ?></td>
                        <td><?php echo e($golongan->ruang); ?></td>
                        <td><?php echo e($golongan->eselon); ?></td>

                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditGolongan', 'modalEditGolongan', {
                        action: '/golongan/<?php echo e($golongan->id); ?>',
                        editKodeGolongan: '<?php echo e($golongan->kode_golongan); ?>',
                        editNamaGolongan: '<?php echo e($golongan->nama_golongan); ?>',
                        editPangkatGolongan: '<?php echo e($golongan->pangkat); ?>',
                        editRuangGolongan: '<?php echo e($golongan->ruang); ?>',
                        editEselonGolongan: '<?php echo e($golongan->eselon); ?>'
                    })""><i class="bi bi-pencil-fill"></i></button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                        'formHapusGolongan',
                        'modalHapusGolongan',
                        '/golongan/<?php echo e($golongan->id); ?>',
                        '<?php echo e($golongan->nama_golongan); ?>',
                        '<?php echo e($golongan->kode_golongan); ?>'
                    )"><i
                                    class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data jabatan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginalf477b6a1964ae4a3b653b87db75f3828 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf477b6a1964ae4a3b653b87db75f3828 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-golongan','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-golongan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf477b6a1964ae4a3b653b87db75f3828)): ?>
<?php $attributes = $__attributesOriginalf477b6a1964ae4a3b653b87db75f3828; ?>
<?php unset($__attributesOriginalf477b6a1964ae4a3b653b87db75f3828); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf477b6a1964ae4a3b653b87db75f3828)): ?>
<?php $component = $__componentOriginalf477b6a1964ae4a3b653b87db75f3828; ?>
<?php unset($__componentOriginalf477b6a1964ae4a3b653b87db75f3828); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\golongan.blade.php ENDPATH**/ ?>