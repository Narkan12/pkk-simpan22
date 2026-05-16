<div id="modalLogout" class="hidden" style="position:fixed;inset:0;z-index:999;align-items:center;justify-content:center;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);">
    <div class="modal-logout-box">

        <div class="modal-logout-icon">
            <i class="bi bi-box-arrow-right" style="font-size:1.5rem;color:#ef4444;"></i>
        </div>

        <h3 class="modal-logout-title">Konfirmasi Keluar</h3>
        <p class="modal-logout-desc">Apakah Anda yakin ingin logout?</p>

        <div class="modal-logout-actions">
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout-confirm">Ya!</button>
            </form>
            <button onclick="closeLogoutModal()" class="btn-logout-cancel">Batal</button>
        </div>
    </div>
</div>
