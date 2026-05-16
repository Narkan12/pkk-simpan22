@props(['id', 'title', 'formTarget' => ''])

<div id="{{ $id }}" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">
    <div class="custom-card" style="border-radius:0.75rem;width:100%;margin:0 1rem;max-width:460px;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1f1f1f;">
            <h5 style="color:#fff;font-weight:700;font-size:1rem;margin:0;">{{ $title }}</h5>
            <button onclick="closeModal('{{ $id }}')" class="modal-close-btn">
                <i class="bi bi-x-lg" style="font-size:13px;"></i>
            </button>
        </div>

        <div style="padding:1rem 1.25rem;display:flex;flex-direction:column;gap:0.75rem;">
            {{ $slot }}
        </div>

        <div style="display:flex;justify-content:flex-end;gap:0.5rem;padding:1rem 1.25rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('{{ $id }}')" class="modal-btn-cancel" style="flex:none;">Batal</button>
            <button type="button" onclick="document.getElementById('{{ $formTarget }}').submit()"
                style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#16a34a;">
                <i class="bi bi-check-lg"></i> Simpan Perubahan
            </button>
        </div>

    </div>
</div>
