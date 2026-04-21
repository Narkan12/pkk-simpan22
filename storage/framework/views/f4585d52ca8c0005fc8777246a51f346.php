

<?php $__env->startSection('title', 'Komponen Gaji'); ?>

<?php $__env->startSection('content'); ?>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Komponen Gaji</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahKomponenGaji')">
            <i class="bi bi-plus"></i> Tambah Komponen
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-komponen-gaji" placeholder="Cari komponen gaji...">
    </div>

    <?php if($errors->any()): ?>
        <div class="alert-error" style="margin-bottom:1rem;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-komponen-gaji">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA KOMPONEN</th>
                    <th>JENIS</th>
                    <th>TIPE NOMINAL</th>
                    <th>NOMINAL</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komponen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($komponen->kode_komponen); ?></td>
                        <td class="font-semibold" style="color:#e6edf3;"><?php echo e($komponen->nama_komponen); ?></td>
                        <td>
                            <?php
                                $JenisKomponen = match ($komponen->jenis) {
                                    'Penghasilan' => 'status-penghasilan',
                                    'Potongan' => 'status-potongan',
                                    default => 'status-lainnya',
                                };
                            ?>
                            <span class="<?php echo e($JenisKomponen); ?>"><?php echo e($komponen->jenis); ?></span>
                        </td>
                        <td>
                            <?php echo e($komponen->tipe_nominal == 'percent' ? 'Persentase (%)' : 'Rupiah (Rp)'); ?>

                        </td>
                        <td>
                            <?php echo e($komponen->tipe_nominal == 'percent'
                                ? $komponen->nominal . '%'
                                : 'Rp ' . number_format($komponen->nominal, 0, ',', '.')); ?>

                        </td>
                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditKomponenGaji', 'modalEditKomponenGaji', {
                                    action: '/komponen-gaji/<?php echo e($komponen->id); ?>',
                                    editKodeKomponen: '<?php echo e($komponen->kode_komponen); ?>',
                                    editNamaKomponen: '<?php echo e($komponen->nama_komponen); ?>',
                                    editJenisKomponen: '<?php echo e($komponen->jenis); ?>',
                                    editTipeNominal: '<?php echo e($komponen->tipe_nominal); ?>',
                                    editNominal: '<?php echo e($komponen->nominal); ?>',
                                    editIdJabatan: '<?php echo e($komponen->id_jabatan); ?>'
                                })">
                                <i class="bi bi-pencil-fill"></i>
                            </button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                                    'formHapusKomponenGaji',
                                    'modalHapusKomponenGaji',
                                    '/komponen-gaji/<?php echo e($komponen->id); ?>',
                                    '<?php echo e($komponen->nama_komponen); ?>',
                                    '<?php echo e($komponen->kode_komponen); ?>'
                                )">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data komponen gaji.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginal73c37cbd98c882f85e03db35f5c2af9c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73c37cbd98c882f85e03db35f5c2af9c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-komponen-gaji','data' => ['jabatan' => $jabatan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-komponen-gaji'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['jabatan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jabatan)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73c37cbd98c882f85e03db35f5c2af9c)): ?>
<?php $attributes = $__attributesOriginal73c37cbd98c882f85e03db35f5c2af9c; ?>
<?php unset($__attributesOriginal73c37cbd98c882f85e03db35f5c2af9c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73c37cbd98c882f85e03db35f5c2af9c)): ?>
<?php $component = $__componentOriginal73c37cbd98c882f85e03db35f5c2af9c; ?>
<?php unset($__componentOriginal73c37cbd98c882f85e03db35f5c2af9c); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-master\komponen-gaji.blade.php ENDPATH**/ ?>