/* =============================================================================
   SIMPAN — app.js
   Berisi semua logika JavaScript global: modal, sidebar, datatable, CRUD, login
   ============================================================================= */

/* ===== AXIOS BOOTSTRAP ===== */
(function () {
    if (typeof axios !== 'undefined') {
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }
})();

/* =============================================================================
   MODAL
   ============================================================================= */

/**
 * Buka modal berdasarkan ID elemen.
 * Untuk modal multi-step (Tambah/Edit Pegawai), reset ke halaman 1 sebelum dibuka.
 * @param {string} idModal - ID elemen modal yang akan dibuka
 */
window.openModal = function (idModal) {
    const elModal = document.getElementById(idModal);
    if (!elModal) return;

    if (idModal === 'modalTambahPegawai') {
        window.halamanTambah = 1;
        if (typeof window.renderModalStep === 'function') {
            window.renderModalStep('tambah', 1);
        }
    }
    if (idModal === 'modalEditPegawai') {
        window.halamanEdit = 1;
        if (typeof window.renderModalStep === 'function') {
            window.renderModalStep('edit', 1);
        }
    }

    elModal.classList.remove('hidden');
    elModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
};

/**
 * Tutup modal berdasarkan ID elemen.
 * @param {string} idModal - ID elemen modal yang akan ditutup
 */
window.closeModal = function (idModal) {
    const elModal = document.getElementById(idModal);
    if (!elModal) return;
    elModal.classList.add('hidden');
    elModal.style.display = 'none';
    document.body.style.overflow = '';
};

/** Buka modal konfirmasi logout */
window.openLogoutModal  = function () { openModal('modalLogout'); };

/** Tutup modal konfirmasi logout */
window.closeLogoutModal = function () { closeModal('modalLogout'); };

// Tutup modal saat klik area luar (overlay)
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="modal"]').forEach(function (elModal) {
        elModal.addEventListener('click', function (e) {
            if (e.target === this) closeModal(this.id);
        });
    });
});

/* =============================================================================
   SIDEBAR
   ============================================================================= */

/**
 * Buka atau tutup submenu dropdown di sidebar.
 * @param {string} idMenu - ID elemen menu dropdown
 * @param {HTMLElement} elTombol - Tombol yang diklik
 */
window.toggleDropdown = function (idMenu, elTombol) {
    const elMenu  = document.getElementById(idMenu);
    const elPanah = elTombol.querySelector('[class*="bi-chevron"]');
    const sedangTerbuka = !elMenu.classList.contains('hidden');

    // Tutup semua dropdown lain
    document.querySelectorAll('#sidebar [id^="menu"]').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('#sidebar .bi-chevron-up').forEach(el => el.classList.replace('bi-chevron-up', 'bi-chevron-down'));

    if (!sedangTerbuka) {
        elMenu.classList.remove('hidden');
        if (elPanah) elPanah.classList.replace('bi-chevron-down', 'bi-chevron-up');
    }
};

/**
 * Toggle sidebar antara mode expanded (210px) dan collapsed (60px).
 * Menyesuaikan posisi header dan margin konten utama secara bersamaan.
 */
window.toggleSidebar = function () {
    const elSidebar = document.getElementById('sidebar');
    const elHeader  = document.getElementById('topHeader');
    const elKonten  = document.getElementById('mainContent');
    if (!elSidebar) return;

    const sedangExpanded = elSidebar.dataset.expanded !== 'false';

    if (sedangExpanded) {
        elSidebar.style.width = '60px';
        if (elHeader) elHeader.style.left = '60px';
        if (elKonten) elKonten.style.marginLeft = '60px';
        elSidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('#sidebar [id^="menu"]').forEach(el => el.classList.add('hidden'));
        elSidebar.dataset.expanded = 'false';
    } else {
        elSidebar.style.width = '210px';
        if (elHeader) elHeader.style.left = '210px';
        if (elKonten) elKonten.style.marginLeft = '210px';
        elSidebar.querySelectorAll('.sidebar-text').forEach(el => el.classList.remove('hidden'));
        elSidebar.dataset.expanded = 'true';
    }
};

/* =============================================================================
   JAM / CLOCK
   ============================================================================= */

/** Perbarui tampilan jam di header admin setiap detik */
function perbaruiJamHeader() {
    const elJam = document.getElementById('currentTime');
    if (!elJam) return;
    const sekarang = new Date();
    elJam.innerText =
        String(sekarang.getHours()).padStart(2, '0') + ':' +
        String(sekarang.getMinutes()).padStart(2, '0') + ':' +
        String(sekarang.getSeconds()).padStart(2, '0');
}
setInterval(perbaruiJamHeader, 1000);
perbaruiJamHeader();

// Jam di dashboard pegawai + tutup modal saat klik overlay
document.addEventListener('DOMContentLoaded', function () {
    const elJamPegawai = document.getElementById('jamPegawai');
    if (elJamPegawai) {
        const perbaruiJamPegawai = () => {
            elJamPegawai.textContent = new Date().toLocaleTimeString('id-ID');
        };
        setInterval(perbaruiJamPegawai, 1000);
        perbaruiJamPegawai();
    }

    ['modalAbsensi', 'modalCuti'].forEach(function (idModal) {
        const elModal = document.getElementById(idModal);
        if (elModal) {
            elModal.addEventListener('click', function (e) {
                if (e.target === this) closeModal(idModal);
            });
        }
    });
});

/* =============================================================================
   MODAL MULTI-STEP (Tambah & Edit Pegawai)
   Fungsi renderTambah dan renderEdit digabung menjadi renderModalStep
   agar tidak ada duplikasi logika.
   ============================================================================= */

window.halamanTambah = 1;
window.halamanEdit   = 1;

window.tambahNext = function () { window.halamanTambah = 2; window.renderModalStep('tambah', 2); };
window.tambahPrev = function () { window.halamanTambah = 1; window.renderModalStep('tambah', 1); };
window.editNext   = function () { window.halamanEdit   = 2; window.renderModalStep('edit',   2); };
window.editPrev   = function () { window.halamanEdit   = 1; window.renderModalStep('edit',   1); };

// Alias agar kode lama yang memanggil renderTambah/renderEdit tetap berfungsi
window.renderTambah = function () { window.renderModalStep('tambah', window.halamanTambah); };
window.renderEdit   = function () { window.renderModalStep('edit',   window.halamanEdit);   };

/**
 * Render tampilan modal multi-step (Tambah atau Edit Pegawai).
 * Menampilkan/menyembunyikan halaman, judul, dan tombol navigasi sesuai halaman aktif.
 * @param {string} tipe    - 'tambah' atau 'edit'
 * @param {number} halaman - Nomor halaman aktif (1 atau 2)
 */
window.renderModalStep = function (tipe, halaman) {
    const prefix = tipe === 'tambah' ? 'tambah' : 'edit';

    // Tampilkan/sembunyikan halaman konten
    [1, 2].forEach(function (nomor) {
        const elHalaman = document.getElementById(prefix + 'Page' + nomor);
        if (!elHalaman) return;
        const isAktif = nomor === halaman;
        elHalaman.classList.toggle('hidden', !isAktif);
        elHalaman.style.display = isAktif ? 'grid' : 'none';
    });

    // Perbarui judul dan subjudul
    const elJudul = document.getElementById(prefix + 'Title');
    const elSub   = document.getElementById(prefix + 'Sub');
    const labelJudul = tipe === 'tambah'
        ? (halaman === 1 ? 'Data Pribadi' : 'Data Kepegawaian')
        : (halaman === 1 ? 'Edit Data Pribadi' : 'Edit Data Kepegawaian');

    if (elJudul) elJudul.textContent = labelJudul;
    if (elSub)   elSub.textContent   = 'Halaman ' + halaman + ' / 2';

    // Tombol Kembali — hanya tampil di halaman 2
    const elBtnPrev = document.getElementById(prefix + 'BtnPrev');
    if (elBtnPrev) {
        const isHalaman2 = halaman === 2;
        elBtnPrev.classList.toggle('hidden', !isHalaman2);
        elBtnPrev.style.display = isHalaman2 ? '' : 'none';
    }

    // Tombol Selanjutnya — hanya tampil di halaman 1
    const elBtnNext = document.getElementById(prefix + 'BtnNext');
    if (elBtnNext) {
        const isHalaman1 = halaman === 1;
        elBtnNext.classList.toggle('hidden', !isHalaman1);
        elBtnNext.style.display = isHalaman1 ? 'flex' : 'none';
    }

    // Tombol Simpan — hanya tampil di halaman 2
    const elBtnSimpan = document.getElementById(prefix + 'BtnSimpan');
    if (elBtnSimpan) {
        const isHalaman2 = halaman === 2;
        elBtnSimpan.classList.toggle('hidden', !isHalaman2);
        elBtnSimpan.style.display = isHalaman2 ? 'flex' : 'none';
    }
};

/* =============================================================================
   DATATABLE
   Fitur: pencarian, sorting kolom, paginasi — tanpa library eksternal
   ============================================================================= */

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('table.datatable').forEach(tabel => inisialisasiDataTable(tabel));
});

/**
 * Inisialisasi fitur DataTable pada elemen <table>.
 * @param {HTMLTableElement} tabel - Elemen tabel yang akan diaktifkan
 */
function inisialisasiDataTable(tabel) {
    const BARIS_PER_HALAMAN = 5;
    const tbody      = tabel.querySelector('tbody');
    const daftarTh   = Array.from(tabel.querySelectorAll('thead th'));
    const idPencarian = tabel.dataset.search;
    const elPencarian = idPencarian ? document.getElementById(idPencarian) : null;

    let semuaBaris  = Array.from(tbody.querySelectorAll('tr'));
    let barisTerfilter = semuaBaris.slice();
    let halamanAktif = 1;
    let kolomSort    = -1;
    let urutanAsc    = true;

    // Simpan teks sel untuk pencarian cepat
    semuaBaris.forEach(baris => {
        baris.dataset.cells = Array.from(baris.querySelectorAll('td'))
            .map(td => td.textContent.trim().toLowerCase())
            .join('|');
    });

    // Buat footer paginasi
    const elWrapper = tabel.closest('.table-dark-custom') || tabel.parentElement;
    const elFooter  = document.createElement('div');
    elFooter.className = 'dt-footer';
    elFooter.style.cssText = 'display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #d4e6d4;background:#f8faf9;border-radius:0 0 10px 10px;';
    elFooter.innerHTML =
        '<span class="dt-info" style="font-size:0.75rem;color:#7a9a7a;"></span>' +
        '<div class="dt-pag" style="display:flex;align-items:center;gap:4px;"></div>';
    elWrapper.appendChild(elFooter);

    const elInfo = elFooter.querySelector('.dt-info');
    const elPag  = elFooter.querySelector('.dt-pag');

    // Event pencarian
    if (elPencarian) {
        elPencarian.addEventListener('input', function () {
            halamanAktif = 1;
            filterBaris(this.value);
            renderTabel();
        });
    }

    // Event sorting kolom
    daftarTh.forEach(function (th, idx) {
        if (th.dataset.sortable === 'false') return;
        th.style.cursor = 'pointer';
        th.addEventListener('click', function () {
            urutanAsc  = kolomSort === idx ? !urutanAsc : true;
            kolomSort  = idx;
            halamanAktif = 1;
            sortBaris();
            renderTabel();
        });
    });

    /** Filter baris berdasarkan kata kunci pencarian */
    function filterBaris(kataCari) {
        const kataLower = kataCari.trim().toLowerCase();
        barisTerfilter = kataLower
            ? semuaBaris.filter(baris => baris.dataset.cells.includes(kataLower))
            : semuaBaris.slice();
        sortBaris();
    }

    /** Urutkan baris berdasarkan kolom yang dipilih */
    function sortBaris() {
        if (kolomSort < 0) return;
        const arah = urutanAsc ? 1 : -1;
        barisTerfilter.sort(function (a, b) {
            const teksA = ((a.querySelectorAll('td')[kolomSort] || {}).textContent || '').trim();
            const teksB = ((b.querySelectorAll('td')[kolomSort] || {}).textContent || '').trim();
            const angkaA = parseFloat(teksA.replace(/[^0-9.-]/g, ''));
            const angkaB = parseFloat(teksB.replace(/[^0-9.-]/g, ''));
            if (!isNaN(angkaA) && !isNaN(angkaB)) return (angkaA - angkaB) * arah;
            return teksA.localeCompare(teksB, 'id') * arah;
        });
    }

    /** Render tabel, info, dan paginasi */
    function renderTabel() {
        const total       = barisTerfilter.length;
        const totalHalaman = Math.max(1, Math.ceil(total / BARIS_PER_HALAMAN));
        if (halamanAktif > totalHalaman) halamanAktif = totalHalaman;

        const mulai = (halamanAktif - 1) * BARIS_PER_HALAMAN;
        const akhir = Math.min(mulai + BARIS_PER_HALAMAN, total);

        tbody.innerHTML = '';
        if (total === 0) {
            tbody.innerHTML = `<tr><td colspan="${daftarTh.length}" style="text-align:center;color:#7a9a7a;font-size:0.875rem;padding:2rem;">Tidak ada data ditemukan.</td></tr>`;
        } else {
            barisTerfilter.slice(mulai, akhir).forEach(baris => tbody.appendChild(baris));
        }

        elInfo.textContent = total === 0
            ? '0 data'
            : `Menampilkan ${mulai + 1}–${akhir} dari ${total} data`;

        renderPaginasi(totalHalaman);

        // Perbarui ikon sort di header
        daftarTh.forEach(function (th, idx) {
            th.querySelector('.dt-sort-icon')?.remove();
            if (idx === kolomSort && th.dataset.sortable !== 'false') {
                const ikonSort = document.createElement('i');
                ikonSort.className = `dt-sort-icon bi bi-caret-${urutanAsc ? 'up' : 'down'}-fill`;
                ikonSort.style.cssText = 'margin-left:4px;font-size:10px;color:#16a34a;';
                th.appendChild(ikonSort);
            }
        });
    }

    /** Render tombol paginasi */
    function renderPaginasi(totalHalaman) {
        const gayaTombol = 'display:inline-flex;align-items:center;justify-content:center;min-width:28px;height:28px;padding:0 6px;font-size:0.75rem;border-radius:6px;border:1px solid #d4e6d4;background:#f0f7f0;color:#1a2e1a;cursor:pointer;transition:background 0.15s;';
        let html = '';

        html += `<button style="${gayaTombol}" data-page="${halamanAktif - 1}" ${halamanAktif === 1 ? 'disabled' : ''}><i class="bi bi-chevron-left" style="font-size:10px"></i></button>`;

        rentangHalaman(halamanAktif, totalHalaman).forEach(function (p) {
            if (p === '...') {
                html += '<span style="padding:0 4px;font-size:0.75rem;color:#7a9a7a;">…</span>';
            } else {
                const gayaAktif = p === halamanAktif ? 'background:#16a34a;border-color:#16a34a;color:#fff;font-weight:600;' : '';
                html += `<button style="${gayaTombol}${gayaAktif}" data-page="${p}">${p}</button>`;
            }
        });

        html += `<button style="${gayaTombol}" data-page="${halamanAktif + 1}" ${halamanAktif === totalHalaman ? 'disabled' : ''}><i class="bi bi-chevron-right" style="font-size:10px"></i></button>`;

        elPag.innerHTML = html;
        elPag.querySelectorAll('button[data-page]:not([disabled])').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                halamanAktif = parseInt(this.dataset.page);
                renderTabel();
            });
        });
    }

    /**
     * Hitung rentang nomor halaman yang ditampilkan di paginasi.
     * @param {number} aktif  - Halaman aktif saat ini
     * @param {number} total  - Total halaman
     * @returns {Array}
     */
    function rentangHalaman(aktif, total) {
        if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
        if (aktif <= 4)          return [1, 2, 3, 4, 5, '...', total];
        if (aktif >= total - 3)  return [1, '...', total - 4, total - 3, total - 2, total - 1, total];
        return [1, '...', aktif - 1, aktif, aktif + 1, '...', total];
    }

    renderTabel();
}

/* =============================================================================
   CRUD — Modal Detail, Edit, Hapus Pegawai
   ============================================================================= */

/**
 * Tampilkan detail pegawai di modal view.
 * @param {Object} data - Objek berisi data pegawai (viewNIK, viewNama, dst.)
 */
window.showDetailPegawai = function (data) {
    // Gabungkan tempat & tanggal lahir
    const ttl   = (data.viewTempatLahir || '-') + ', ' + (data.viewTanggalLahir || '-');
    const elTTL = document.getElementById('viewTTL');
    if (elTTL) elTTL.textContent = ttl;

    // Peta key data → ID elemen di modal
    const petaElemen = {
        viewNIK:              'viewNIK',
        viewNIP:              'viewNIP',
        viewNama:             'viewNamaTitle',
        viewJenisKelamin:     'viewJenisKelamin',
        viewAgama:            'viewAgama',
        viewStatusPernikahan: 'viewStatusNikah',
        viewNoTelepon:        'viewTelp',
        viewAlamat:           'viewAlamat',
        viewJabatan:          'viewJabatan',
        viewDepartemen:       'viewDepartemen',
        viewGolongan:         'viewGolongan',
        viewPendidikan:       'viewPendidikan',
        viewTglMasuk:         'viewTglMasuk',
        viewJenisPegawai:     'viewJenisPegawai',
    };

    Object.entries(data).forEach(function ([kunci, nilai]) {
        if (kunci === 'viewTempatLahir' || kunci === 'viewTanggalLahir') return;
        const idElemen = petaElemen[kunci];
        if (idElemen) {
            const el = document.getElementById(idElemen);
            if (el) el.textContent = nilai || '-';
        }
    });

    // Tampilkan foto atau inisial nama
    const elFoto        = document.getElementById('viewFoto');
    const elPlaceholder = document.getElementById('viewFotoPlaceholder');
    const elNipJudul    = document.getElementById('viewNipTitle');

    if (elFoto && elPlaceholder) {
        if (data.viewFoto?.trim()) {
            elFoto.src = '/storage/' + data.viewFoto;
            elFoto.style.display = 'block';
            elPlaceholder.style.display = 'none';
        } else {
            elFoto.style.display = 'none';
            elPlaceholder.style.display = 'flex';
            const inisial = (data.viewNama || '?').split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
            elPlaceholder.textContent = inisial || '?';
        }
    }

    if (elNipJudul) elNipJudul.textContent = data.viewNIP || '-';

    // Badge status
    const elStatus = document.getElementById('viewStatus');
    if (elStatus) {
        elStatus.innerHTML = `<span class="${data.viewStatusClass} mt-1 inline-block">${data.viewStatus}</span>`;
    }

    // Badge departemen
    const elDepartemen = document.getElementById('viewDepartemen');
    if (elDepartemen) {
        elDepartemen.innerHTML = `<span class="status-departemen mt-1 inline-block">${data.viewDepartemen}</span>`;
    }

    openModal('modalViewPegawai');
};

/**
 * Buka modal edit generik dan isi field form dengan data yang diberikan.
 * @param {string} idForm   - ID form di dalam modal edit
 * @param {string} idModal  - ID modal yang akan dibuka
 * @param {Object} fields   - Objek berisi { action, idField: nilai, ... }
 */
window.openModalEditGeneric = function (idForm, idModal, fields) {
    const elForm = document.getElementById(idForm);
    if (!elForm) return;

    elForm.action = fields.action;
    Object.entries(fields).forEach(function ([idField, nilai]) {
        const elField = document.getElementById(idField);
        if (elField) elField.value = nilai;
    });

    openModal(idModal);
};

/**
 * Buka modal hapus generik dan isi nama & kode data yang akan dihapus.
 * @param {string} idForm   - ID form hapus
 * @param {string} idModal  - ID modal hapus
 * @param {string} action   - URL action form DELETE
 * @param {string} nama     - Nama data yang akan dihapus
 * @param {string} [kode]   - Kode/NIP data (opsional)
 */
window.openModalHapusGeneric = function (idForm, idModal, action, nama, kode) {
    const elForm = document.getElementById(idForm);
    if (elForm) elForm.action = action;

    const elNama = document.getElementById('hapusNama');
    const elKode = document.getElementById('hapusKode');
    if (elNama) elNama.textContent = nama;
    if (elKode) elKode.textContent = kode || '';

    openModal(idModal);
};

/* =============================================================================
   LOGIN
   ============================================================================= */

document.addEventListener('DOMContentLoaded', function () {
    const elDataLogin = document.getElementById('loginData');
    if (elDataLogin) {
        const urlRedirect  = elDataLogin.dataset.success;
        const adaError     = elDataLogin.dataset.error;

        if (urlRedirect) {
            const elBtnLanjut = document.getElementById('btnLanjutkan');
            if (elBtnLanjut) elBtnLanjut.href = urlRedirect;

            const elModalSukses = document.getElementById('modalLoginSuccess');
            if (elModalSukses) {
                elModalSukses.classList.remove('hidden');
                elModalSukses.style.display = 'flex';
            }

            // Hitung mundur 3 detik lalu redirect otomatis
            let sisaDetik = 3;
            const timerHitungMundur = setInterval(function () {
                sisaDetik--;
                const elHitung = document.getElementById('countdown');
                if (elHitung) elHitung.textContent = sisaDetik;
                if (sisaDetik <= 0) {
                    clearInterval(timerHitungMundur);
                    window.location.href = urlRedirect;
                }
            }, 1000);
        }

        if (adaError) {
            const elModalGagal = document.getElementById('modalLoginError');
            if (elModalGagal) {
                elModalGagal.classList.remove('hidden');
                elModalGagal.style.display = 'flex';
            }
        }
    }

    // Toggle visibilitas password
    const elTogglePassword = document.getElementById('togglePassword');
    if (elTogglePassword) {
        elTogglePassword.addEventListener('click', function () {
            const elPassword = document.getElementById('password');
            const elIkonMata = document.getElementById('eyeIcon');
            const sedangTersembunyi = elPassword.type === 'password';
            elPassword.type      = sedangTersembunyi ? 'text' : 'password';
            elIkonMata.className = sedangTersembunyi ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    }
});

/** Tutup modal login sukses dan gagal */
window.closeLoginModal = function () {
    const elSukses = document.getElementById('modalLoginSuccess');
    const elGagal  = document.getElementById('modalLoginError');
    if (elSukses) { elSukses.classList.add('hidden'); elSukses.style.display = 'none'; }
    if (elGagal)  { elGagal.classList.add('hidden');  elGagal.style.display  = 'none'; }
};

/* =============================================================================
   PREVIEW & VALIDASI FOTO
   ============================================================================= */

document.addEventListener('DOMContentLoaded', function () {
    const elFotoTambah = document.getElementById('fotoInputAdd');
    if (elFotoTambah) {
        elFotoTambah.addEventListener('change', e => tampilkanPreviewFoto(e, 'fotoPreviewAdd', 'fotoPreviewImg'));
    }

    const elFotoEdit = document.getElementById('fotoInputEdit');
    if (elFotoEdit) {
        elFotoEdit.addEventListener('change', e => tampilkanPreviewFoto(e, 'fotoPreviewEdit', 'fotoPreviewImgEdit'));
    }
});

/**
 * Validasi dan tampilkan preview foto yang dipilih pengguna.
 * @param {Event}  event              - Event change dari input file
 * @param {string} idKontainerPreview - ID elemen kontainer preview
 * @param {string} idGambarPreview    - ID elemen <img> preview
 */
window.tampilkanPreviewFoto = function (event, idKontainerPreview, idGambarPreview) {
    const fileDipilih    = event.target.files[0];
    const UKURAN_MAKS    = 2 * 1024 * 1024; // 2 MB
    const TIPE_DIIZINKAN = ['image/jpeg', 'image/png', 'image/jpg'];

    const elKontainer = document.getElementById(idKontainerPreview);
    const elGambar    = document.getElementById(idGambarPreview);

    if (!fileDipilih) {
        if (elKontainer) elKontainer.style.display = 'none';
        return;
    }

    if (!TIPE_DIIZINKAN.includes(fileDipilih.type)) {
        alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
        event.target.value = '';
        if (elKontainer) elKontainer.style.display = 'none';
        return;
    }

    if (fileDipilih.size > UKURAN_MAKS) {
        alert('Ukuran file terlalu besar. Maksimal 2MB.');
        event.target.value = '';
        if (elKontainer) elKontainer.style.display = 'none';
        return;
    }

    const pembacaFile = new FileReader();
    pembacaFile.onload = function (e) {
        if (elGambar) {
            elGambar.src = e.target.result;
            if (elKontainer) elKontainer.style.display = 'block';
        }
    };
    pembacaFile.readAsDataURL(fileDipilih);
};

// Alias untuk kompatibilitas kode lama
window.handlePhotoPreview = window.tampilkanPreviewFoto;
