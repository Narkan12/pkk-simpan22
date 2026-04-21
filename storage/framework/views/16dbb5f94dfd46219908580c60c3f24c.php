<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['jabatanList', 'departemenList', 'statusList', 'golonganList', 'pendidikanList']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['jabatanList', 'departemenList', 'statusList', 'golonganList', 'pendidikanList']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>


<div id="modalTambahPegawai" class="hidden"
    style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">
    <div class="custom-card"
        style="border-radius:0.75rem;width:100%;margin:0 1rem;display:flex;flex-direction:column;max-width:560px; max-height:90vh;">
        <form id="formTambahPegawai" action="<?php echo e(route('dataPegawai.insert')); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;flex-shrink:0;border-bottom:1px solid #1f1f1f;">
                <div>
                    <h5 style="color:#fff;font-weight:700;font-size:1rem;margin:0;" id="tambahTitle">Data Pribadi</h5>
                    <p class="custom-paragraph" style="font-size:0.75rem;margin:2px 0 0;" id="tambahSub">Halaman 1 / 2
                    </p>
                </div>
                <button type="button" onclick="closeModal('modalTambahPegawai')" class="modal-close-btn">
                    <i class="bi bi-x-lg" style="font-size:13px;"></i>
                </button>
            </div>

            
            <div id="tambahPage1"
                style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;overflow-y:auto;max-height:400px;">
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">NIK
                        <span style="color:#e05c5c;">*</span></label>
                    <input type="text" name="NIK" placeholder="Nomor Induk Kependudukan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">NIP
                        <span style="color:#e05c5c;">*</span></label>
                    <input type="text" name="NIP" placeholder="Nomor Induk Pegawai" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>

                <div style="grid-column:span 2;">
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Foto
                        Pegawai</label>
                    <input type="file" id="fotoInputAdd" name="foto" accept="image/jpeg,image/png,image/jpg"
                        class="modal-input" style="width:100%;font-size:0.875rem;">
                    <p style="font-size:10px; margin-top:4px;">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
                    <!-- Preview -->
                    <div id="fotoPreviewAdd" style="display:none; margin-top:0.75rem; text-align:center;">
                        <img id="fotoPreviewImg" src=""
                            style="max-width:120px; height:auto; border-radius:0.75rem; border:2px solid #16a34a;">
                    </div>
                </div>

                <div style="grid-column:span 2;">
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama
                        Lengkap <span style="color:#e05c5c;">*</span></label>
                    <input type="text" name="nama_lengkap" placeholder="Sesuai KTP" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis
                        Kelamin <span style="color:#e05c5c;">*</span></label>
                    <select name="jenis_kelamin" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Agama</label>
                    <select name="agama" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" placeholder="Kota lahir" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status Pernikahan</label>
                    <select name="status_pernikahan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">No.
                        Telepon</label>
                    <input type="text" name="no_telp" placeholder="08xxxxxxxxxx" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alamat</label>
                    <textarea name="alamat" rows="2" placeholder="Alamat lengkap" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9; resize:none;"></textarea>
                </div>
            </div>

            
            <div id="tambahPage2" class="hidden"
                style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;overflow-y:auto;max-height:400px;">
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jabatan <span
                            style="color:#e05c5c;">*</span></label>
                    <select name="id_jabatan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih Jabatan</option>
                        <?php $__currentLoopData = $jabatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->id); ?>"><?php echo e($j->nama_jabatan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Departemen <span
                            style="color:#e05c5c;">*</span></label>
                    <select name="id_departemen" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih Departemen</option>
                        <?php $__currentLoopData = $departemenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama_departemen); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Golongan</label>
                    <select name="id_golongan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $golonganList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($g->id); ?>"><?php echo e($g->nama_golongan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Pendidikan Terakhir</label>
                    <select name="id_pendidikan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $pendidikanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p->id); ?>"><?php echo e($p->jenjang); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Masuk <span
                            style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_masuk" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Pegawai</label>
                    <select name="jenis_pegawai" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Pegawai Tetap">Pegawai Tetap</option>
                        <option value="Pegawai Kontrak">Pegawai Kontrak</option>
                    </select>
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status <span
                            style="color:#e05c5c;">*</span></label>
                    <select name="id_status" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->nama_status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div style="grid-column:span 2;border-top:1px solid #2a2a2a;padding-top:0.75rem;margin-top:0.25rem;">
                    <p class="custom-paragraph" style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:0.5rem;">
                        <i class="bi bi-key me-1"></i> Akun Login Pegawai
                    </p>
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                        Email <span style="color:#e05c5c;">*</span>
                    </label>
                    <input type="email" name="email" placeholder="contoh@email.com" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p style="color:#e05c5c;font-size:0.7rem;margin-top:3px;"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                        Password <span style="color:#e05c5c;">*</span>
                    </label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p style="color:#e05c5c;font-size:0.7rem;margin-top:3px;"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p style="font-size:0.7rem;color:#8b949e;margin-top:3px;">Username login = Nama Lengkap pegawai</p>
                </div>
            </div>

            
            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;flex-shrink:0;border-top:1px solid #1f1f1f;">
                <p class="custom-paragraph" style="font-size:0.75rem;margin:0;color:#555;">
                    <span style="color:#e05c5c;">*</span> Wajib diisi
                </p>
                <div style="display:flex;gap:0.5rem;">
                    <button type="button" onclick="closeModal('modalTambahPegawai')"
                        style="padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
                    <button type="button" id="tambahBtnPrev" onclick="tambahPrev()" class="hidden"
                        style="padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;background:#1a1a1a;color:#c9d1d9;border:1px solid #2a2a2a;">Kembali</button>
                    <button type="button" id="tambahBtnNext" onclick="tambahNext()"
                        style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;border:none;background-color:#1a6fdf;" class="text-white">
                        Selanjutnya <i class="bi bi-chevron-right" style="font-size:11px;"></i>
                    </button>
                    <button type="submit" id="tambahBtnSimpan" class="hidden"
                        style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background-color:#16a34a;">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>




<div id="modalViewPegawai" class="hidden"
    style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">

    <div class="custom-card"
        style="border-radius:0.75rem;width:100%;margin:0 1rem;display:flex;flex-direction:column;max-width:540px; max-height:85vh; overflow:hidden;">

        <div
            style="padding:1.25rem; display:flex; align-items:center; gap:1rem; border-bottom:1px solid #e5e7eb; flex-shrink:0;">
            <img id="viewFoto" src=""
                style="width:80px; height:80px; border-radius:12px; object-fit:cover; border:2px solid #16a34a; background:#f0fdf4; display:none;">
            <div id="viewFotoPlaceholder"
                style="width:80px; height:80px; border-radius:12px; background:#16a34a; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.75rem; font-weight:bold;">
                ?
            </div>
            <div style="flex-grow: 1;">
                <h4 id="viewNamaTitle" style="color:#111827; margin:0; font-size:1.1rem;">-</h4>
                <p id="viewNipTitle" style="color:#6b7280; margin:0; font-size:0.875rem;">-</p>
            </div>
            <button type="button" onclick="closeModal('modalViewPegawai')" class="modal-close-btn"
                style="align-self: flex-start;">
                <i class="bi bi-x-lg" style="font-size:14px;"></i>
            </button>
        </div>

        <div style="padding:1.25rem; display:flex; flex-direction:column; gap:1.25rem; overflow-y:auto; flex-grow:1;">

            
            <div>
                <p
                    style="font-size:0.75rem; font-weight:600; margin-bottom:0.75rem; color:#16a34a; letter-spacing:0.07em; text-transform:uppercase;">
                    <i class="bi bi-person me-1"></i> Data Pribadi
                </p>
                <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:0.75rem 1.25rem;">
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">NIK</p>
                        <p id="viewNIK" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">NIP</p>
                        <p id="viewNIP" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Agama</p>
                        <p id="viewAgama" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Jenis
                            Kelamin</p>
                        <p id="viewJenisKelamin" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-
                        </p>
                    </div>
                    <div style="grid-column: span 2;">
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Tempat,
                            Tgl Lahir</p>
                        <p id="viewTTL" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">No.
                            Telepon</p>
                        <p id="viewTelp" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Status
                            Pernikahan</p>
                        <p id="viewStatusNikah" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-
                        </p>
                    </div>
                    <div style="grid-column: span 2;">
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Alamat
                        </p>
                        <p id="viewAlamat"
                            style="color:#111827; font-size:0.8rem; font-weight:500; margin:0; white-space:pre-wrap; line-height:1.4;">
                            -</p>
                    </div>

                </div>
            </div>

            <div style="border-top:1px solid #e5e7eb;"></div>

            
            <div>
                <p
                    style="font-size:0.75rem; font-weight:600; margin-bottom:0.75rem; color:#16a34a; letter-spacing:0.07em; text-transform:uppercase;">
                    <i class="bi bi-briefcase me-1"></i> Data Kepegawaian
                </p>
                <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:0.75rem 1.25rem;">
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Jabatan
                        </p>
                        <p id="viewJabatan" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">
                            Departemen</p>
                        <p id="viewDepartemen" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-
                        </p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Tanggal
                            Masuk</p>
                        <p id="viewTglMasuk" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Jenis
                            Pegawai</p>
                        <p id="viewJenisPegawai" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-
                        </p>
                    </div>
                    <div>
                        <p class="custom-paragraph mb-0" style="font-size:10px; opacity:0.7; color:#6b7280;">Status
                        </p>
                        <p id="viewStatus" style="color:#111827; font-size:0.8rem; font-weight:600; margin:0;">-</p>
                    </div>
                </div>
            </div>
        </div>

        <div
            style="display:flex; justify-content:flex-end; padding:1rem 1.25rem; border-top:1px solid #1f1f1f; flex-shrink:0;">
            <button type="button" onclick="closeModal('modalViewPegawai')"
                style="padding:0.5rem 1.25rem; border-radius:0.5rem; font-size:0.875rem; font-weight:600; cursor:pointer; background:#1a1a1a; color:#8b949e; border:1px solid #2a2a2a;">

                Tutup
            </button>
        </div>
    </div>
</div>


<div id="modalEditPegawai" class="hidden"
    style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">
    <div class="custom-card"
        style="border-radius:0.75rem;width:100%;margin:0 1rem;display:flex;flex-direction:column;max-width:560px; max-height:90vh;">
        <form id="formEditPegawai" method="POST" action="">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;flex-shrink:0;border-bottom:1px solid #1f1f1f;">
                <div>
                    <h5 style="color:#fff;font-weight:700;font-size:1rem;margin:0;" id="editTitle">Edit Data Pribadi
                    </h5>
                    <p class="custom-paragraph" style="font-size:0.75rem;margin:2px 0 0;" id="editSub">Halaman 1 /
                        2</p>
                </div>
                <button type="button" onclick="closeModal('modalEditPegawai')" class="modal-close-btn">
                    <i class="bi bi-x-lg" style="font-size:13px;"></i>
                </button>
            </div>

            
            <div id="editPage1"
                style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;overflow-y:auto;max-height:400px;">
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">NIK
                        <span style="color:#e05c5c;">*</span></label>
                    
                    <input type="text" name="NIK" id="editNik" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">NIP
                        <span style="color:#e05c5c;">*</span></label>
                    
                    <input type="text" name="NIP" id="editNip" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Lengkap <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <input type="text" name="nama_lengkap" id="editNama" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Kelamin <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <select name="jenis_kelamin" id="editJk" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Agama</label>
                    
                    <select name="agama" id="editAgama" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Aliran Kepercayaan">Aliran Kepercayaan</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tempat Lahir</label>
                    
                    <input type="text" name="tempat_lahir" id="editTempatLahir" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Lahir</label>
                    
                    <input type="date" name="tanggal_lahir" id="editTglLahir" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status Pernikahan</label>
                    
                    <select name="status_pernikahan" id="editStatusNikah" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">No.
                        Telepon</label>
                    
                    <input type="text" name="no_telp" id="editNoTelp" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alamat</label>
                    
                    <textarea name="alamat" id="editAlamat" rows="2" placeholder="Alamat lengkap" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9; resize:none;"></textarea>
                </div>
            </div>

            
            <div id="editPage2" class="hidden"
                style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;overflow-y:auto;max-height:400px;">
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jabatan <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <select name="id_jabatan" id="editIdJabatan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih Jabatan</option>
                        <?php $__currentLoopData = $jabatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($j->id); ?>"><?php echo e($j->nama_jabatan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Departemen <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <select name="id_departemen" id="editIdDepartemen" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih Departemen</option>
                        <?php $__currentLoopData = $departemenList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama_departemen); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Golongan</label>
                    
                    <select name="id_golongan" id="editIdGolongan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $golonganList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($g->id); ?>"><?php echo e($g->nama_golongan); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Pendidikan Terakhir</label>
                    
                    <select name="id_pendidikan" id="editIdPendidikan" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $pendidikanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p->id); ?>"><?php echo e($p->jenjang); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Masuk <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <input type="date" name="tanggal_masuk" id="editTglMasuk" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Pegawai</label>
                    
                    <select name="jenis_pegawai" id="editJenisPegawai" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Pegawai Tetap">Pegawai Tetap</option>
                        <option value="Pegawai Kontrak">Pegawai Kontrak</option>
                    </select>
                </div>
                <div style="grid-column:span 2;">
                    <label class="custom-paragraph"
                        style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status <span
                            style="color:#e05c5c;">*</span></label>
                    
                    <select name="id_status" id="editIdStatus" class="modal-input"
                        style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->nama_status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;flex-shrink:0;border-top:1px solid #1f1f1f;">
                <p class="custom-paragraph" style="font-size:0.75rem;margin:0;color:#555;">
                    <span style="color:#e05c5c;">*</span> Wajib diisi
                </p>
                <div style="display:flex;gap:0.5rem;">
                    <button type="button" onclick="closeModal('modalEditPegawai')"
                        style="padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
                    <button type="button" id="editBtnPrev" onclick="editPrev()" class="hidden"
                        style="padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;background:#1a1a1a;color:#c9d1d9;border:1px solid #2a2a2a;">Kembali</button>
                    <button type="button" id="editBtnNext" onclick="editNext()"
                        style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;cursor:pointer;border:none;background-color:#1a6fdf;" class="text-white">
                        Selanjutnya <i class="bi bi-chevron-right" style="font-size:11px;"></i>
                    </button>
                    <button type="submit" id="editBtnSimpan" class="hidden"
                        style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background-color:#16a34a;">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php if (isset($component)) { $__componentOriginal2b3245a5746dec4123f46f887cebc745 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b3245a5746dec4123f46f887cebc745 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.delete','data' => ['id' => 'modalHapusPegawai','title' => 'Hapus Pegawai','formId' => 'formHapusPegawai']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalHapusPegawai','title' => 'Hapus Pegawai','formId' => 'formHapusPegawai']); ?>
    <form method="POST" id="formHapusPegawai" action="">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b3245a5746dec4123f46f887cebc745)): ?>
<?php $attributes = $__attributesOriginal2b3245a5746dec4123f46f887cebc745; ?>
<?php unset($__attributesOriginal2b3245a5746dec4123f46f887cebc745); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b3245a5746dec4123f46f887cebc745)): ?>
<?php $component = $__componentOriginal2b3245a5746dec4123f46f887cebc745; ?>
<?php unset($__componentOriginal2b3245a5746dec4123f46f887cebc745); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-data-pegawai.blade.php ENDPATH**/ ?>