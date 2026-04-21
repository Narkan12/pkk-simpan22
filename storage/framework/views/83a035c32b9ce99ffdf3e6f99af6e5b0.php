

<?php $__env->startSection('title', 'Daftar Pegawai'); ?>

<?php $__env->startSection('content'); ?>

    
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Daftar Pegawai</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahPegawai')">
            <i class="bi bi-plus"></i> Tambah Pegawai
        </button>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert-error"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert-error">
            <ul style="margin:0;padding-left:1.25rem;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="cards-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Total Pegawai</p>
            <h3 style="color:#fff;font-size:1.25rem;font-weight:700;margin:0;"><?php echo e($totalPegawai); ?></h3>
        </div>
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Pegawai Aktif</p>
            <h3 style="font-size:1.25rem;font-weight:700;margin:0;color:#3fb950;"><?php echo e($pegawaiAktif); ?></h3>
        </div>
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Pegawai Nonaktif/ Lainnya</p>
            <h3 style="font-size:1.25rem;font-weight:700;margin:0;color:#eab308;"><?php echo e(($pegawaiNonAktif ?? 0) + ($pegawaiLainnya ?? 0)); ?></h3>
        </div>
    </div>

    
    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-data-pegawai" placeholder="Cari NIP, Nama, atau Jabatan...">
    </div>

    
    <div class="table-dark-custom" style="margin-top:1rem;">
        <table class="w-full datatable" data-search="search-data-pegawai">
            <thead>
                <tr>
                    <th style="width:50px;">FOTO</th>
                    <th>NIP</th>
                    <th>NAMA LENGKAP</th>
                    <th>JABATAN</th>
                    <th>DEPARTEMEN</th>
                    <th>GOLONGAN</th>
                    <th>STATUS</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pegawai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $statusName = $pegawai->status->nama_status ?? '';
                        $warnaStatus = match (strtolower($statusName)) {
                            'aktif'              => 'status-active',
                            'cuti'               => 'status-cuti',
                            'non-aktif','nonaktif' => 'status-nonaktif',
                            'pensiun'            => 'status-pensiun',
                            'kontrak'            => 'status-kontrak',
                            default              => 'status-lainnya',
                        };
                    ?>
                    <tr>
                        <td style="text-align:center; padding:0.75rem 1.25rem;">
                            <?php if($pegawai->foto): ?>
                                <img src="<?php echo e(asset('storage/' . $pegawai->foto)); ?>"
                                    style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #16a34a;">
                            <?php else: ?>
                                <div style="width:36px; height:36px; border-radius:50%; background:#16a34a; display:inline-flex; align-items:center; justify-content:center; color:#fff; font-weight:600; font-size:0.75rem;">
                                    <?php echo e(strtoupper(substr($pegawai->nama_lengkap, 0, 2))); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="text-xs font-semibold"><?php echo e($pegawai->NIP); ?></td>
                        <td class="font-semibold" style="color:#111827;"><?php echo e($pegawai->nama_lengkap); ?></td>
                        <td><?php echo e($pegawai->jabatan->nama_jabatan ?? '-'); ?></td>
                        <td> <span class="status-departemen"><?php echo e($pegawai->departemen->nama_departemen ?? '-'); ?></span></td>
                        <td> <?php echo e($pegawai->golongan->nama_golongan ?? '-'); ?></td>
                        <td><span class="<?php echo e($warnaStatus); ?>"><?php echo e(ucfirst($statusName ?: '-')); ?></span></td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;">

                                
                                <button type="button" class="btn-view" title="Lihat Detail"
                                    onclick="showDetailPegawai({
                                        viewNIK:              '<?php echo e($pegawai->NIK ?? '-'); ?>',
                                        viewNIP:              '<?php echo e($pegawai->NIP ?? '-'); ?>',
                                        viewNama:             '<?php echo e(addslashes($pegawai->nama_lengkap ?? '-')); ?>',
                                        viewJenisKelamin:     '<?php echo e(($pegawai->jenis_kelamin ?? '') === 'L' ? 'Laki-laki' : 'Perempuan'); ?>',
                                        viewAgama:            '<?php echo e($pegawai->agama ?? '-'); ?>',
                                        viewTempatLahir:      '<?php echo e($pegawai->tempat_lahir ?? '-'); ?>',
                                        viewTanggalLahir:     '<?php echo e($pegawai->tanggal_lahir ?? '-'); ?>',
                                        viewStatusPernikahan: '<?php echo e($pegawai->status_pernikahan ?? '-'); ?>',
                                        viewNoTelepon:        '<?php echo e($pegawai->no_telp ?? '-'); ?>',
                                        viewAlamat:           '<?php echo e(addslashes($pegawai->alamat ?? '-')); ?>',
                                        viewJabatan:          '<?php echo e($pegawai->jabatan->nama_jabatan ?? '-'); ?>',
                                        viewDepartemen:       '<?php echo e($pegawai->departemen->nama_departemen ?? '-'); ?>',
                                        viewGolongan:         '<?php echo e($pegawai->golongan->nama_golongan ?? '-'); ?>',
                                        viewPendidikan:       '<?php echo e($pegawai->pendidikan->jenjang ?? '-'); ?>',
                                        viewTglMasuk:         '<?php echo e($pegawai->tanggal_masuk ?? '-'); ?>',
                                        viewJenisPegawai:     '<?php echo e($pegawai->jenis_pegawai ?? '-'); ?>',
                                        viewStatus:           '<?php echo e(ucfirst($statusName)); ?>',
                                        viewStatusClass:      '<?php echo e($warnaStatus); ?>',
                                        viewFoto:             '<?php echo e($pegawai->foto ?? ''); ?>',

                                    })">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                
                                <button type="button" class="btn-view" title="Edit"
                                    onclick="openModalEditGeneric('formEditPegawai', 'modalEditPegawai', {
                                        action:           '<?php echo e(route('dataPegawai.update', $pegawai->id)); ?>',
                                        editNik:          '<?php echo e($pegawai->NIK); ?>',
                                        editNip:          '<?php echo e($pegawai->NIP); ?>',
                                        editNama:         '<?php echo e(addslashes($pegawai->nama_lengkap)); ?>',
                                        editJk:           '<?php echo e($pegawai->jenis_kelamin); ?>',
                                        editAgama:        '<?php echo e($pegawai->agama); ?>',
                                        editTempatLahir:  '<?php echo e($pegawai->tempat_lahir); ?>',
                                        editTglLahir:     '<?php echo e($pegawai->tanggal_lahir); ?>',
                                        editAlamat:       '<?php echo e(addslashes($pegawai->alamat)); ?>',
                                        editNoTelp:       '<?php echo e($pegawai->no_telp); ?>',
                                        editStatusNikah:  '<?php echo e($pegawai->status_pernikahan); ?>',
                                        editJenisPegawai: '<?php echo e($pegawai->jenis_pegawai); ?>',
                                        editIdJabatan:    '<?php echo e($pegawai->id_jabatan); ?>',
                                        editIdDepartemen: '<?php echo e($pegawai->id_departemen); ?>',
                                        editIdGolongan:   '<?php echo e($pegawai->id_golongan); ?>',
                                        editIdPendidikan: '<?php echo e($pegawai->id_pendidikan); ?>',
                                        editIdStatus:     '<?php echo e($pegawai->id_status); ?>',
                                        editTglMasuk:     '<?php echo e($pegawai->tanggal_masuk); ?>'
                                    })">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                
                                <button type="button" class="btn-delete" title="Hapus"
                                    onclick="openModalHapusGeneric(
                                        'formHapusPegawai',
                                        'modalHapusPegawai',
                                        '<?php echo e(route('dataPegawai.delete', $pegawai->id)); ?>',
                                        '<?php echo e(addslashes($pegawai->nama_lengkap)); ?>',
                                        '<?php echo e($pegawai->NIP); ?>'
                                    )">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-8 ms-5" style="color:#7a9a7a;">
                            Data pegawai tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($component)) { $__componentOriginal13c98b894352c4ef74c2ff1568f87bd9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13c98b894352c4ef74c2ff1568f87bd9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal-layout.modal-data-pegawai','data' => ['jabatanList' => $jabatanList,'departemenList' => $departemenList,'statusList' => $statusList,'golonganList' => $golonganList,'pendidikanList' => $pendidikanList]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal-layout.modal-data-pegawai'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['jabatanList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($jabatanList),'departemenList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($departemenList),'statusList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statusList),'golonganList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($golonganList),'pendidikanList' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pendidikanList)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13c98b894352c4ef74c2ff1568f87bd9)): ?>
<?php $attributes = $__attributesOriginal13c98b894352c4ef74c2ff1568f87bd9; ?>
<?php unset($__attributesOriginal13c98b894352c4ef74c2ff1568f87bd9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13c98b894352c4ef74c2ff1568f87bd9)): ?>
<?php $component = $__componentOriginal13c98b894352c4ef74c2ff1568f87bd9; ?>
<?php unset($__componentOriginal13c98b894352c4ef74c2ff1568f87bd9); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\data-pegawai.blade.php ENDPATH**/ ?>