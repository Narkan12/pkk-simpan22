
<div id="modalLoginSuccess" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.5);">
    <div style="background:#fff;border-radius:1rem;box-shadow:0 10px 25px rgba(0,0,0,0.15);padding:2rem;width:320px;text-align:center;">
        <div style="display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#dcfce7;margin:0 auto 1rem;">
            <i class="bi bi-check-lg" style="font-size:1.5rem;color:#16a34a;"></i>
        </div>
        <h3 style="font-size:1rem;font-weight:600;color:#1f2937;margin-bottom:0.25rem;">Login Berhasil!</h3>
        <p style="font-size:0.75rem;color:#9ca3af;margin-bottom:1.25rem;">
            Otomatis masuk dalam <span id="countdown" style="font-weight:600;color:#2d7a3e;">3</span> detik...
        </p>
        <a id="btnLanjutkan" href="#" style="display:block;width:100%;padding:0.5rem;border-radius:0.5rem;background:#2d7a3e;color:#fff;font-size:0.875rem;font-weight:500;text-decoration:none;transition:background 0.2s;">
            Lanjutkan Sekarang
        </a>
    </div>
</div>


<div id="modalLoginError" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.5);">
    <div style="background:#fff;border-radius:1rem;box-shadow:0 10px 25px rgba(0,0,0,0.15);padding:2rem;width:320px;text-align:center;">
        <div style="display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#fee2e2;margin:0 auto 1rem;">
            <i class="bi bi-x-lg" style="font-size:1.5rem;color:#ef4444;"></i>
        </div>
        <h3 style="font-size:1rem;font-weight:600;color:#1f2937;margin-bottom:0.25rem;">Login Gagal</h3>
        <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1.25rem;">Username atau password yang kamu masukkan salah.</p>
        <button onclick="closeLoginModal()" style="width:100%;padding:0.5rem;border-radius:0.5rem;background:#ef4444;color:#fff;font-size:0.875rem;font-weight:500;border:none;cursor:pointer;transition:background 0.2s;">
            Coba Lagi
        </button>
    </div>
</div>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-login.blade.php ENDPATH**/ ?>