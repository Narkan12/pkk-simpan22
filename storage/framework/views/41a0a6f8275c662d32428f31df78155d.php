
<div id="modalViewCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding-left:1rem;padding-right:1rem;background:rgba(0,0,0,0.7);">
    <div style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:480px;background:#161b22;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Detail Pengajuan Cuti</p>
            <button onclick="closeModal('modalViewCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
        </div>

        <div style="padding:1rem;display:flex;flex-direction:column;gap:0.75rem;">
            <div>
                <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#388bfd;letter-spacing:0.07em;text-transform:uppercase;">
                    <i class="bi bi-person me-1"></i> Data Pegawai
                </p>
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Nama</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Budi Santoso</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">NIP</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">198501012010011001</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Departemen</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">IT</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Jabatan</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Software Engineer</p></div>
                </div>
            </div>
            <div style="border-top:1px solid #1f1f1f;"></div>
            <div>
                <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#eab308;letter-spacing:0.07em;text-transform:uppercase;">
                    <i class="bi bi-calendar-check me-1"></i> Detail Cuti
                </p>
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Jenis Cuti</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Cuti Tahunan</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Durasi</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">5 hari</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Tanggal Mulai</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">20 Maret 2026</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Tanggal Selesai</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">24 Maret 2026</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Sisa Cuti</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">7 hari</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Status</p><p style="margin:0;"><span class="status-cuti">Pending</span></p></div>
                    <div style="grid-column:span 2;"><p style="color:#8b949e;font-size:0.75rem;margin:0;">Alasan</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Keperluan keluarga</p></div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('modalViewCuti')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Tutup</button>
            <button onclick="closeModal('modalViewCuti'); openModal('modalTolakCuti')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#a32d2d;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-x-circle-fill"></i> Tolak</button>
            <button onclick="closeModal('modalViewCuti'); openModal('modalSetujuiCuti')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#238636;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-check-circle-fill"></i> Setujui</button>
        </div>

    </div>
</div>


<div id="modalSetujuiCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding-left:1rem;padding-right:1rem;background:rgba(0,0,0,0.7);">
    <div style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:360px;background:#161b22;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Setujui Pengajuan Cuti</p>
            <button onclick="closeModal('modalSetujuiCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
        </div>

        <div style="padding:1.25rem 1rem;text-align:center;display:flex;flex-direction:column;align-items:center;gap:0.75rem;">
            <div style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;" style="background:rgba(35,134,54,0.15);border:1px solid rgba(35,134,54,0.4);">
                <i class="bi bi-check-circle-fill" style="font-size:18px;color:#3fb950;"></i>
            </div>
            <div>
                <p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;margin-bottom:0.25rem;">Yakin ingin menyetujui cuti ini?</p>
                <p style="color:#8b949e;font-size:0.75rem;margin:0;">Budi Santoso &mdash; Cuti Tahunan &mdash; 5 hari</p>
            </div>
        </div>

        <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('modalSetujuiCuti')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
            <button onclick="closeModal('modalSetujuiCuti')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#238636;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-check-circle-fill"></i> Ya, Setujui</button>
        </div>

    </div>
</div>


<div id="modalTolakCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding-left:1rem;padding-right:1rem;background:rgba(0,0,0,0.7);">
    <div style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:360px;background:#161b22;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Tolak Pengajuan Cuti</p>
            <button onclick="closeModal('modalTolakCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
        </div>

        <div style="padding:1rem;display:flex;flex-direction:column;gap:0.75rem;">
            <div style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:0.75rem;">
                <div style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;background:rgba(163,45,45,0.15);border:1px solid rgba(163,45,45,0.4);">
                    <i class="bi bi-x-circle-fill" style="font-size:18px;color:#f85149;"></i>
                </div>
                <div>
                    <p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;margin-bottom:0.25rem;">Yakin ingin menolak cuti ini?</p>
                    <p style="color:#8b949e;font-size:0.75rem;margin:0;">Budi Santoso &mdash; Cuti Tahunan &mdash; 5 hari</p>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('modalTolakCuti')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
            <button onclick="closeModal('modalTolakCuti')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#a32d2d;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-x-circle-fill"></i> Ya, Tolak</button>
        </div>

    </div>
</div>


<?php if (isset($component)) { $__componentOriginal7798093c4a64f2ca6baa1b3744349deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.add','data' => ['id' => 'modalTambahCuti','title' => 'Tambah Pengajuan Cuti']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.add'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalTambahCuti','title' => 'Tambah Pengajuan Cuti']); ?>
    <div style="grid-column:span 2;">
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Pegawai <span style="color:#e05c5c;">*</span></label>
        <input type="text" placeholder="Cari nama pegawai..." class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div style="grid-column:span 2;">
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Cuti <span style="color:#e05c5c;">*</span></label>
        <select class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
            <option value="">Pilih Jenis Cuti</option>
            <option>Cuti Tahunan</option>
            <option>Cuti Sakit</option>
            <option>Cuti Melahirkan</option>
            <option>Cuti Besar</option>
        </select>
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Mulai <span style="color:#e05c5c;">*</span></label>
        <input type="date" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Selesai <span style="color:#e05c5c;">*</span></label>
        <input type="date" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div style="grid-column:span 2;">
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alasan</label>
        <textarea rows="2" placeholder="Alasan pengajuan cuti..." class="modal-input" style="width:100%;font-size:0.875rem;resize:none;color:#c9d1d9;"></textarea>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7798093c4a64f2ca6baa1b3744349deb)): ?>
<?php $attributes = $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb; ?>
<?php unset($__attributesOriginal7798093c4a64f2ca6baa1b3744349deb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7798093c4a64f2ca6baa1b3744349deb)): ?>
<?php $component = $__componentOriginal7798093c4a64f2ca6baa1b3744349deb; ?>
<?php unset($__componentOriginal7798093c4a64f2ca6baa1b3744349deb); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal2b3245a5746dec4123f46f887cebc745 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b3245a5746dec4123f46f887cebc745 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.delete','data' => ['id' => 'modalHapusCuti','title' => 'Hapus Pengajuan Cuti','nama' => 'Budi Santoso','kode' => 'Cuti Tahunan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalHapusCuti','title' => 'Hapus Pengajuan Cuti','nama' => 'Budi Santoso','kode' => 'Cuti Tahunan']); ?>
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
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-cuti.blade.php ENDPATH**/ ?>