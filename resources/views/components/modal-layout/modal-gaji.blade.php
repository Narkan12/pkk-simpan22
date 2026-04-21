{{-- Modal View Detail Gaji --}}
<div id="modalViewGaji" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(0,0,0,0.7);">
    <div style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:480px;background:#161b22;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Detail Gaji Pegawai</p>
            <button onclick="closeModal('modalViewGaji')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
        </div>

        <div style="padding:1rem;display:flex;flex-direction:column;gap:0.75rem;">
            <div>
                <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#388bfd;letter-spacing:0.07em;text-transform:uppercase;">
                    <i class="bi bi-person me-1"></i> Data Pegawai
                </p>
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Nama</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Budi Santoso</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">NIP</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">198501012010011001</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Jabatan</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Software Engineer</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">No. Rekening</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">1234567890 (BCA)</p></div>
                </div>
            </div>
            <div style="border-top:1px solid #1f1f1f;"></div>
            <div>
                <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#03C950;letter-spacing:0.07em;text-transform:uppercase;">
                    <i class="bi bi-cash-stack me-1"></i> Rincian Gaji
                </p>
                <div style="border-radius:0.5rem;overflow:hidden;border:1px solid #1f1f1f;">
                    <div style="display:flex;justify-content:space-between;padding:0.625rem 1rem;border-bottom:1px solid #1f1f1f;font-size:0.75rem;"><span style="color:#8b949e;">Gaji Pokok</span><span style="color:#fff;font-weight:600;">Rp 8.500.000</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.625rem 1rem;border-bottom:1px solid #1f1f1f;font-size:0.75rem;"><span style="color:#8b949e;">Tunjangan</span><span style="color:#fff;font-weight:600;">Rp 1.200.000</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.625rem 1rem;border-bottom:1px solid #1f1f1f;font-size:0.75rem;"><span style="color:#8b949e;">Potongan</span><span style="font-weight:600;" style="color:#e05c5c;">- Rp 850.000</span></div>
                    <div style="display:flex;justify-content:space-between;padding:0.625rem 1rem;font-size:0.75rem;" style="background:rgba(3,201,80,0.06);"><span style="color:#fff;font-weight:700;">Total Diterima</span><span style="color:#fff;font-weight:700;">Rp 8.850.000</span></div>
                </div>
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;margin-top:0.75rem;">
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Periode</p><p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;">Maret 2026</p></div>
                    <div><p style="color:#8b949e;font-size:0.75rem;margin:0;">Status</p><p style="margin:0;"><span class="status-active">Sudah Dibayar</span></p></div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('modalViewGaji')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Tutup</button>
            <button onclick="closeModal('modalViewGaji'); openModal('modalBayarGaji')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#238636;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-check-circle-fill"></i> Tandai Dibayar</button>
        </div>

    </div>
</div>

{{-- Modal Konfirmasi Pembayaran --}}
<div id="modalBayarGaji" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(0,0,0,0.7);">
    <div style="border-radius:0.5rem;width:100%;border:1px solid #1f1f1f;max-width:360px;background:#161b22;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;border-bottom:1px solid #1f1f1f;">
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin:0;">Konfirmasi Pembayaran</p>
            <button onclick="closeModal('modalBayarGaji')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
        </div>

        <div style="padding:1.25rem 1rem;text-align:center;display:flex;flex-direction:column;align-items:center;gap:0.75rem;">
            <div style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;" style="background:rgba(3,201,80,0.15);border:1px solid rgba(3,201,80,0.4);">
                <i class="bi bi-cash-coin" style="font-size:18px;color:#03C950;"></i>
            </div>
            <div>
                <p style="color:#fff;font-size:0.875rem;font-weight:600;margin:0;margin-bottom:0.25rem;">Tandai gaji ini sebagai sudah dibayar?</p>
                <p style="color:#8b949e;font-size:0.75rem;margin:0;">Budi Santoso &mdash; Rp 8.850.000 &mdash; Maret 2026</p>
            </div>
        </div>

        <div style="display:flex;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('modalBayarGaji')" class="modal-btn-cancel" style="background:#1a1a1a;color:#8b949e;border:1px solid #2a2a2a;">Batal</button>
            <button onclick="closeModal('modalBayarGaji')" style="flex:1;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#238636;display:flex;align-items:center;justify-content:center;gap:0.375rem;"><i class="bi bi-check-circle-fill"></i> Ya, Konfirmasi</button>
        </div>

    </div>
</div>

{{-- Modal Tambah Gaji --}}
<x-modal.add id="modalTambahGaji" title="Tambah Data Gaji">
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Pegawai <span style="color:#e05c5c;">*</span></label>
        <input type="text" placeholder="Cari nama pegawai..." class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;" placeholder-style="color:#8b949e;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Periode <span style="color:#e05c5c;">*</span></label>
        <input type="month" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Gaji Pokok <span style="color:#e05c5c;">*</span></label>
        <input type="text" placeholder="Contoh: 8500000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tunjangan</label>
        <input type="text" placeholder="Contoh: 1200000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Potongan</label>
        <input type="text" placeholder="Contoh: 850000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status</label>
        <select class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
            <option value="">Pilih Status</option>
            <option>Sudah Dibayar</option>
            <option>Belum Dibayar</option>
        </select>
    </div>
</x-modal.add>

{{-- Modal Edit Gaji --}}
<x-modal.update id="modalEditGaji" title="Edit Data Gaji">
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Pegawai <span style="color:#e05c5c;">*</span></label>
        <input type="text" value="Budi Santoso" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Periode <span style="color:#e05c5c;">*</span></label>
        <input type="month" value="2026-03" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Gaji Pokok <span style="color:#e05c5c;">*</span></label>
        <input type="text" value="8500000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tunjangan</label>
        <input type="text" value="1200000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Potongan</label>
        <input type="text" value="850000" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
    </div>
    <div>
        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Status</label>
        <select class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
            <option selected>Sudah Dibayar</option>
            <option>Belum Dibayar</option>
        </select>
    </div>
</x-modal.update>

{{-- Modal Hapus Gaji --}}
<x-modal.delete id="modalHapusGaji" title="Hapus Data Gaji" nama="Budi Santoso" kode="198501012010011001" />
