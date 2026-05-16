@props(['id', 'title', 'nama' => '', 'kode' => '', 'formId' => 'formHapus'])

<div id="{{ $id }}" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">
    <div class="custom-card" style="border-radius:0.75rem;width:100%;margin:0 1rem;max-width:400px;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1f1f1f;">
            <h5 style="color:#fff;font-weight:700;font-size:1rem;margin:0;">{{ $title }}</h5>
            <button onclick="closeModal('{{ $id }}')" class="modal-close-btn">
                <i class="bi bi-x-lg" style="font-size:13px;"></i>
            </button>
        </div>

        <div style="padding:1.25rem;text-align:center;">
            <div style="width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;background:rgba(224,92,92,0.1);border:1px solid rgba(224,92,92,0.3);">
                <i class="bi bi-trash-fill" style="font-size:22px;color:#e05c5c;"></i>
            </div>
            <p style="color:#fff;font-weight:600;font-size:0.875rem;margin-bottom:0.25rem;">Hapus data ini?</p>
            <p class="custom-paragraph" style="font-size:0.75rem;margin:0;">
                <span style="color:#fff;font-weight:600;" id="hapusNama">{{ $nama }}</span>
                <span id="hapusKodeWrap"> — <span id="hapusKode">{{ $kode }}</span></span>
            </p>
            <p class="custom-paragraph" style="font-size:0.75rem;margin-top:0.5rem;">Tindakan ini tidak dapat dibatalkan.</p>
            {{ $slot }}
        </div>

        <div style="display:flex;gap:0.75rem;padding:1rem 1.25rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('{{ $id }}')" class="modal-btn-cancel" style="flex:1;">Batal</button>
            <button type="button" onclick="document.getElementById('{{ $formId }}').submit()"
                style="flex:1;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#e05c5c;">
                <i class="bi bi-trash-fill me-1"></i> Ya, Hapus
            </button>
        </div>

    </div>
</div>
