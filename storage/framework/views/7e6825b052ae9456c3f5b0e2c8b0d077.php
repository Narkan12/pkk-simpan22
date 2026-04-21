
    <div id="modalAbsensi" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding-left:1rem;padding-right:1rem;background:rgba(0,0,0,0.7);">
        <form action="<?php echo e(route('absensi.simpan')); ?>" method="POST" style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:360px;background:#161b22;">
            <?php echo csrf_field(); ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
                <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Catat Absensi</p>
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-close-btn">
                    <i class="bi bi-x-lg" style="font-size:11px;"></i>
                </button>
            </div>
            <div style="padding:1rem;display:flex;flex-direction:column;gap:0.75rem;">
                <div class="rounded-lg p-3 text-center border" style="background:rgba(3,201,80,0.06);border-color:rgba(3,201,80,0.2);">
                    <p style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;"><?php echo e(now()->isoFormat('dddd, D MMMM Y')); ?></p>
                    <p class="text-white font-bold text-xl mb-0" id="jamPegawai">--:--:--</p>
                </div>
                <div>
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis</label>
                    <select name="jenis" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="masuk">Check-in</option>
                        <option value="keluar">Check-out</option>
                    </select>
                </div>
                <div>
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Opsional" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
            </div>
            <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
                <button type="submit" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#16a34a;">Simpan</button>
            </div>
        </form>
    </div>

    
    <div id="modalCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding-left:1rem;padding-right:1rem;background:rgba(0,0,0,0.7);">
        <form action="<?php echo e(route('cuti.ajukan')); ?>" method="POST" style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:400px;background:#161b22;">
            <?php echo csrf_field(); ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
                <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Ajukan Cuti</p>
                <button type="button" onclick="closeModal('modalCuti')" class="modal-close-btn">
                    <i class="bi bi-x-lg" style="font-size:11px;"></i>
                </button>
            </div>
            <div style="padding:1rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                <div style="grid-column:span 2;">
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Cuti <span style="color:#e05c5c;">*</span></label>
                    <select name="jenis_cuti" required class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                        <option value="">Pilih</option>
                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                        <option value="Cuti Sakit">Cuti Sakit</option>
                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                        <option value="Izin Penting">Izin Penting</option>
                    </select>
                </div>
                <div>
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Mulai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_mulai" required class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div>
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Selesai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_selesai" required class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                </div>
                <div style="grid-column:span 2;">
                    <label style="color:#8b949e;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alasan</label>
                    <textarea name="alasan" rows="2" placeholder="Alasan cuti" class="modal-input" style="width:100%;font-size:0.875rem;resize:none;color:#c9d1d9;"></textarea>
                </div>
            </div>
            <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
                <button type="button" onclick="closeModal('modalCuti')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
                <button type="submit" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#1a6fdf;">Kirim</button>
            </div>
        </form>
    </div>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-dashboard-pegawai.blade.php ENDPATH**/ ?>