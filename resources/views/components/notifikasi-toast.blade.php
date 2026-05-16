
<div id="toast-container"
    style="position:fixed;top:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:10px;min-width:300px;pointer-events:none;">
</div>

<style>
/* === Toast item === */
.toast-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    font-size: 14px;
    font-family: inherit;
    animation: toastMasuk 0.3s ease forwards;
    max-width: 360px;
    word-break: break-word;
    pointer-events: all;
    line-height: 1.5;
}
.toast-error   { background:#FEE2E2; border-left:4px solid #EF4444; color:#991B1B; }
.toast-sukses  { background:#D1FAE5; border-left:4px solid #10B981; color:#065F46; }
.toast-warning { background:#FEF3C7; border-left:4px solid #F59E0B; color:#92400E; }
.toast-tutup {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
    color: inherit;
    opacity: 0.5;
    flex-shrink: 0;
    padding: 0;
    margin-top: -2px;
}
.toast-tutup:hover { opacity: 1; }

@keyframes toastMasuk {
    from { transform: translateX(110%); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
}
@keyframes toastKeluar {
    from { transform: translateX(0);    opacity: 1; }
    to   { transform: translateX(110%); opacity: 0; }
}
</style>

<script>
/**
 * Tampilkan notifikasi toast.
 * @param {string} pesan  - Isi pesan (boleh HTML)
 * @param {string} tipe   - 'sukses' | 'error' | 'warning'
 * @param {number} durasi - Durasi tampil dalam ms (default 4000)
 */
function tampilkanToast(pesan, tipe = 'error', durasi = 4000) {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = 'toast-item toast-' + tipe;

    // Ikon sesuai tipe
    const ikon = tipe === 'sukses' ? '✓' : tipe === 'warning' ? '⚠' : '✕';

    toast.innerHTML =
        '<span style="font-size:16px;flex-shrink:0;">' + ikon + '</span>' +
        '<span style="flex:1;">' + pesan + '</span>' +
        '<button class="toast-tutup" onclick="tutupToast(this.parentElement)" title="Tutup">×</button>';

    container.appendChild(toast);

    // Hilang otomatis setelah durasi
    setTimeout(function () { tutupToast(toast); }, durasi);
}

/** Tutup dan hapus elemen toast dengan animasi keluar */
function tutupToast(el) {
    if (!el || !el.parentElement) return;
    el.style.animation = 'toastKeluar 0.3s ease forwards';
    setTimeout(function () { el.remove(); }, 300);
}

// Tampilkan toast dari session Laravel saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {

    {{-- Pesan sukses dari controller --}}
    @if(session('success'))
        tampilkanToast(@json(session('success')), 'sukses');
    @endif

    {{-- Pesan error dari controller --}}
    @if(session('error'))
        tampilkanToast(@json(session('error')), 'error');
    @endif

    {{-- Pesan warning dari controller --}}
    @if(session('warning'))
        tampilkanToast(@json(session('warning')), 'warning');
    @endif

    {{-- Pesan danger (alias warning) dari controller --}}
    @if(session('danger'))
        tampilkanToast(@json(session('danger')), 'warning');
    @endif

    {{-- Error validasi Laravel — tampilkan semua dalam satu toast --}}
    @if($errors->any())
        const daftarError = @json($errors->all());
        const pesanError = '<strong>Form belum lengkap!</strong><br>' + daftarError.join('<br>');
        tampilkanToast(pesanError, 'error', 6000);
    @endif

});

// Validasi sisi client — cegah submit jika ada field required kosong
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {

        form.addEventListener('submit', function (e) {
            const fieldKosong = [];

            form.querySelectorAll('[required]').forEach(function (input) {
                // Ambil label dari elemen terdekat
                const elLabel = input.closest('div')?.querySelector('label');
                const namaField = elLabel?.innerText?.replace('*', '').trim()
                    || input.placeholder
                    || input.name
                    || 'Field ini';

                if (!input.value.trim()) {
                    fieldKosong.push(namaField + ' harus diisi.');
                    input.style.borderColor = '#EF4444'; // highlight merah
                } else {
                    input.style.borderColor = '';
                }
            });

            if (fieldKosong.length > 0) {
                e.preventDefault(); // tahan submit ke server
                tampilkanToast(
                    '<strong>Form belum lengkap!</strong><br>' + fieldKosong.join('<br>'),
                    'error'
                );
            }
        });

        // Reset highlight merah saat user mulai mengisi
        form.querySelectorAll('[required]').forEach(function (input) {
            input.addEventListener('input', function () {
                if (input.value.trim()) {
                    input.style.borderColor = '';
                }
            });
        });
    });
});
</script>
