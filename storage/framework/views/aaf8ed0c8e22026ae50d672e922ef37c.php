

<?php $__env->startSection('title', 'Pendidikan'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Pendidikan Karyawan</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahPendidikan')">
            <i class="bi bi-plus"></i> Tambah Pendidikan
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-pendidikan" placeholder="Cari pendidikan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-pendidikan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>JENJANG</th>
                    <th>DESKRIPSI</th>
                    <th>LAMA STUDI (TAHUN)</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendidikan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($pendidikan->kode_pendidikan); ?></td>
        <td class="font-semibold" style="color:#e6edf3;"><?php echo e($pendidikan->jenjang); ?></td>
                        <td><?php echo e($pendidikan->deskripsi ?? '-'); ?></td>
                        <td><?php echo e($pendidikan->lama_studi); ?></td>
                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditPendidikan', 'modalEditPendidikan', {
                                action: '/pendidikan/<?php echo e($pendidikan->id); ?>',
                                editKodePendidikan: '<?php echo e($pendidikan->kode_pendidikan); ?>',
                                editJenjangPendidikan: '<?php echo e($pendidikan->jenjang); ?>',
                                editDeskripsiPendidikan: '<?php echo e($pendidikan->deskripsi); ?>',
                                editLamaStudiPendidikan: '<?php echo e($pendidikan->lama_studi); ?>'
                            })"><i class="bi bi-pencil-fill"></i></button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                                'formHapusPendidikan',
                                'modalHapusPendidikan',
                                '/pendidikan/<?php echo e($pendidikan->id); ?>',
                                '<?php echo e($pendidikan->jenjang); ?>',
                                '<?php echo e($pendidikan->kode_pendidikan); ?>'
                            )"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data pendidikan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginal82b9bd3692535bd3b81973c404561f44 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82b9bd3692535bd3b81973c404561f44 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-pendidikan','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-pendidikan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal82b9bd3692535bd3b81973c404561f44)): ?>
<?php $attributes = $__attributesOriginal82b9bd3692535bd3b81973c404561f44; ?>
<?php unset($__attributesOriginal82b9bd3692535bd3b81973c404561f44); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal82b9bd3692535bd3b81973c404561f44)): ?>
<?php $component = $__componentOriginal82b9bd3692535bd3b81973c404561f44; ?>
<?php unset($__componentOriginal82b9bd3692535bd3b81973c404561f44); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\pendidikan.blade.php ENDPATH**/ ?>