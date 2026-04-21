

<?php $__env->startSection('title', 'Jabatan'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Jabatan</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahJabatan')">
            <i class="bi bi-plus"></i> Tambah Jabatan
        </button>
    </div>

    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-jabatan" placeholder="Cari jabatan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-jabatan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA JABATAN</th>
                    <th>LEVEL</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jabatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($jabatan->kode_jabatan); ?></td>
                <td><span class="status-jabatan"><?php echo e($jabatan->nama_jabatan); ?></span></td>
                <td><?php echo e($jabatan->level); ?></td>
                <td>Rp <?php echo e(number_format($jabatan->gaji_pokok ?? 0, 0, ',', '.')); ?></td>
                <td>Rp <?php echo e(number_format($jabatan->tunjangan ?? 0, 0, ',', '.')); ?></td>
                <td>
                    <button class="btn-view" onclick="openModalEditGeneric('formEditJabatan', 'modalEditJabatan', {
                        action: '/jabatan/<?php echo e($jabatan->id); ?>',
                        editKode: '<?php echo e($jabatan->kode_jabatan); ?>',
                        editNama: '<?php echo e($jabatan->nama_jabatan); ?>',
                        editLevel: '<?php echo e($jabatan->level); ?>',
                        editGajiPokok: '<?php echo e($jabatan->gaji_pokok ?? 0); ?>',
                        editTunjangan: '<?php echo e($jabatan->tunjangan ?? 0); ?>'
                    })"><i class="bi bi-pencil-fill"></i></button>

                    <button class="btn-delete" onclick="openModalHapusGeneric(
                        'formHapusJabatan',
                        'modalHapusJabatan',
                        '/jabatan/<?php echo e($jabatan->id); ?>',
                        '<?php echo e($jabatan->nama_jabatan); ?>',
                        '<?php echo e($jabatan->kode_jabatan); ?>'
                    )"><i class="bi bi-trash-fill"></i></button>
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

    <?php if (isset($component)) { $__componentOriginala8c53fb3843bd8fb94b43b8a65731780 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8c53fb3843bd8fb94b43b8a65731780 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-jabatan','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-jabatan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8c53fb3843bd8fb94b43b8a65731780)): ?>
<?php $attributes = $__attributesOriginala8c53fb3843bd8fb94b43b8a65731780; ?>
<?php unset($__attributesOriginala8c53fb3843bd8fb94b43b8a65731780); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8c53fb3843bd8fb94b43b8a65731780)): ?>
<?php $component = $__componentOriginala8c53fb3843bd8fb94b43b8a65731780; ?>
<?php unset($__componentOriginala8c53fb3843bd8fb94b43b8a65731780); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\jabatan.blade.php ENDPATH**/ ?>