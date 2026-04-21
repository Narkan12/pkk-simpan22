

<?php $__env->startSection('title', 'Status'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Status Pegawai</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahStatus')">
            <i class="bi bi-plus"></i> Tambah Status Pegawai
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-status" placeholder="Cari status pegawai...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-status">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA STATUS</th>
                    <th>DESKRIPSI</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($status->kode_status); ?></td>
                        <td>
                            <?php
                                $warnaStatus = match (strtolower($status->nama_status)) {
                                    'aktif' => 'status-active',
                                    'cuti' => 'status-cuti',
                                    'non-aktif', 'nonaktif' => 'status-nonaktif',
                                    'pensiun' => 'status-pensiun',
                                    'kontrak' => 'status-kontrak',
                                    default => 'status-lainnya',
                                };
                            ?>
                            <span class="<?php echo e($warnaStatus); ?>"><?php echo e($status->nama_status); ?></span>
                        </td>
                        <td><?php echo e($status->deskripsi ?? '-'); ?></td>
                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditStatus', 'modalEditStatus', {
                            action: '/status/<?php echo e($status->id); ?>',
                            editKodeStatus: '<?php echo e($status->kode_status); ?>',
                            editNamaStatus: '<?php echo e($status->nama_status); ?>',
                            editDeskripsiStatus: '<?php echo e($status->deskripsi); ?>'
                        })"><i
                                    class="bi bi-pencil-fill"></i></button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                            'formHapusStatus',
                            'modalHapusStatus',
                            '/status/<?php echo e($status->id); ?>',
                            '<?php echo e($status->nama_status); ?>',
                            '<?php echo e($status->kode_status); ?>'
                        )"><i
                                    class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data status.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginalbf4017913e0299826d509f339fb61b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbf4017913e0299826d509f339fb61b2c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-status','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbf4017913e0299826d509f339fb61b2c)): ?>
<?php $attributes = $__attributesOriginalbf4017913e0299826d509f339fb61b2c; ?>
<?php unset($__attributesOriginalbf4017913e0299826d509f339fb61b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbf4017913e0299826d509f339fb61b2c)): ?>
<?php $component = $__componentOriginalbf4017913e0299826d509f339fb61b2c; ?>
<?php unset($__componentOriginalbf4017913e0299826d509f339fb61b2c); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\status.blade.php ENDPATH**/ ?>