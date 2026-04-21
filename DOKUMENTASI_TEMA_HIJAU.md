# DOKUMENTASI: TEMA HIJAU PROFESIONAL & FITUR UPLOAD FOTO PEGAWAI

**Tanggal:** 2026-04-13  
**Sistem:** HRIS PKK-Simpan22  
**Status:** ✅ Implementasi Selesai  

---

## 📋 RINGKASAN PERUBAHAN

Telah berhasil mengimplementasikan:
1. **Tema Hijau Profesional** - Mengubah dark theme menjadi tema hijau yang modern dan profesional
2. **Fitur Upload Foto Pegawai** - Upload, simpan, dan tampilkan foto pegawai di berbagai tempat
3. **Preview Real-time** - Preview foto sebelum upload
4. **Avatar Display** - Tampilkan avatar foto atau inisial di tabel dan modal

---

## 🎨 PALET WARNA HIJAU PROFESIONAL

Semua warna sudah terdefinisi dalam CSS variables:

```css
--color-primary:       #16a34a  /* Hijau utama - tombol, aktif */
--color-primary-dark:  #15803d  /* Hijau tua - hover state */
--color-primary-light: #dcfce7  /* Hijau muda - background badge/chip */
--color-accent:        #22c55e  /* Hijau accent - highlight, border aktif */
--color-bg-main:       #f0fdf4  /* Background utama */
--color-bg-card:       #ffffff  /* Card/panel */
--color-text-main:     #111827  /* Text utama */
--color-text-secondary:#6b7280  /* Text sekunder */
--color-border:        #e5e7eb  /* Border default */
```

**Komponen yang diubah:**
- ✅ Sidebar (hijau gelap #166534 dengan text putih)
- ✅ Header (putih dengan border ringan)
- ✅ Cards (putih dengan border grey ringan)
- ✅ Buttons (hijau dengan hover lebih gelap)
- ✅ Forms (putih dengan border hijau saat focus)
- ✅ Tables (header hijau muda, row zebra putih)
- ✅ Modals (putih dengan styling konsisten)
- ✅ Status badges (warni sesuai status)

---

## 📸 FITUR UPLOAD FOTO PEGAWAI

### A. Form Upload (Modal Tambah Pegawai)

**Lokasi:** `resources/views/components/modal-layout/modal-data-pegawai.blade.php` (baris 41-47)

**Fitur:**
- Upload file JPG, PNG, JPEG (maks 2MB)
- Preview real-time saat file dipilih
- Validasi client-side tipe file dan ukuran
- Validasi server-side (lihat Controller)

**HTML:**
```blade
<div style="grid-column:span 2;">
    <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
        Foto Pegawai
    </label>
    <input type="file" id="fotoInputAdd" name="foto" 
        accept="image/jpeg,image/png,image/jpg" class="modal-input"
        style="width:100%;font-size:0.875rem;">
    <p style="font-size:10px; margin-top:4px;">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
    
    <!-- Preview -->
    <div id="fotoPreviewAdd" style="display:none; margin-top:0.75rem; text-align:center;">
        <img id="fotoPreviewImg" src="" 
            style="max-width:120px; height:auto; border-radius:0.75rem; border:2px solid #16a34a;">
    </div>
</div>
```

### B. Controller (Handle Upload & Validasi)

**Lokasi:** `app/Http/Controllers/DataMasterController.php`

**Method:** `dataPegawaiInsert()` - Tambah pegawai baru

```php
public function dataPegawaiInsert(Request $request)
{
    $request->validate([
        'NIK'           => 'required|unique:employees,NIK',
        'NIP'           => 'required|unique:employees,NIP',
        'nama_lengkap'  => 'required|string|max:150',
        'jenis_kelamin' => 'required|in:L,P',
        'tanggal_masuk' => 'required|date',
        'id_jabatan'    => 'nullable|exists:jabatan,id',
        'id_departemen' => 'nullable|exists:departemen,id',
        'id_status'     => 'nullable|exists:status_pegawai,id',
        'id_golongan'   => 'nullable|exists:golongan,id',
        'id_pendidikan' => 'nullable|exists:pendidikan,id',
        'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ← Validasi foto
    ]);

    $data = $request->all();

    // Handle foto upload
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('foto_pegawai', $filename, 'public');
        $data['foto'] = $path; // Simpan path ke database
    }

    $pegawai = Employees::create($data);
    $this->catatLog("Menambahkan pegawai baru: {$pegawai->nama_lengkap}");

    return $this->berhasil('Pegawai berhasil ditambahkan.');
}
```

**Fitur Validasi:**
- `image` - File harus berupa image
- `mimes:jpg,jpeg,png` - Hanya JPG/PNG yang diterima
- `max:2048` - Maksimal 2MB

**Penyimpanan:**
- Path: `storage/app/public/foto_pegawai/`
- Nama file: `{timestamp}_{uniqid}.{extension}`
- Database: Kolom `foto` di tabel `employees`

**Method:** `dataPegawaiUpdate()` - Edit pegawai (termasuk ganti foto)

```php
public function dataPegawaiUpdate(Request $request, Employees $pegawai)
{
    // ... validasi ...
    
    // Handle foto update
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($pegawai->foto && \Storage::disk('public')->exists($pegawai->foto)) {
            \Storage::disk('public')->delete($pegawai->foto);
        }

        // Upload foto baru
        $file = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('foto_pegawai', $filename, 'public');
        $data['foto'] = $path;
    }

    $pegawai->update($data);
    // ... logging ...
}
```

### C. Model Employees

**Lokasi:** `app/Models/Employees.php`

**Update fillable array:**
```php
protected $fillable = [
    'id_user',
    'NIK',
    'NIP',
    'foto',  // ← Ditambahkan
    'nama_lengkap',
    'jenis_kelamin',
    // ... field lainnya ...
];
```

### D. Tabel Data Pegawai

**Lokasi:** `resources/views/data-pegawai.blade.php` (baris 41-48)

**Fitur Tampilan:**
- Kolom FOTO sebagai kolom pertama (lebar 50px)
- Tampilkan foto jika ada, atau avatar inisial jika tidak ada
- Avatar ukuran 36x36px, border-radius 50%, border hijau #16a34a

**HTML:**
```blade
<td style="text-align:center; padding:0.75rem 1.25rem;">
    @if($pegawai->foto)
        <img src="{{ asset('storage/' . $pegawai->foto) }}"
            style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #16a34a;">
    @else
        <div style="width:36px; height:36px; border-radius:50%; background:#16a34a; display:inline-flex; align-items:center; justify-content:center; color:#fff; font-weight:600; font-size:0.75rem;">
            {{ strtoupper(substr($pegawai->nama_lengkap, 0, 2)) }}
        </div>
    @endif
</td>
```

**Pass viewFoto ke showDetailPegawai:**
```blade
onclick="showDetailPegawai({
    viewNIK:              '{{ $pegawai->NIK ?? '-' }}',
    viewNIP:              '{{ $pegawai->NIP ?? '-' }}',
    viewNama:             '{{ addslashes($pegawai->nama_lengkap ?? '-') }}',
    // ... field lainnya ...
    viewFoto:             '{{ $pegawai->foto ?? '' }}', // ← Tambahan
})">
```

### E. Modal View Pegawai (Detail)

**Lokasi:** `resources/views/components/modal-layout/modal-data-pegawai.blade.php` (baris 228-244)

**Fitur:**
- Tampilkan foto di atas modal (80x80px)
- Border hijau #16a34a
- Rounded corners
- Fallback ke avatar inisial jika tidak ada foto

**HTML:**
```blade
<img id="viewFoto" src=""
    style="width:80px; height:80px; border-radius:12px; object-fit:cover; 
    border:2px solid #16a34a; background:#f0fdf4; display:none;">
<div id="viewFotoPlaceholder"
    style="width:80px; height:80px; border-radius:12px; background:#16a34a; 
    display:flex; align-items:center; justify-content:center; 
    color:#fff; font-size:1.75rem; font-weight:bold;">
    ?
</div>
```

### F. JavaScript (Preview & Display)

**Lokasi:** `public/js/app.js`

**Function 1: Handle Photo Preview**
```javascript
window.handlePhotoPreview = function (event, previewContainerId, previewImgId) {
    var file = event.target.files[0];
    var maxSize = 2 * 1024 * 1024; // 2MB
    var allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

    // Validasi tipe file
    if (!allowedTypes.includes(file.type)) {
        alert("Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.");
        event.target.value = "";
        return;
    }

    // Validasi ukuran
    if (file.size > maxSize) {
        alert("Ukuran file terlalu besar. Maksimal 2MB.");
        event.target.value = "";
        return;
    }

    // Baca file dan tampilkan preview
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById(previewImgId);
        var container = document.getElementById(previewContainerId);
        if (img) {
            img.src = e.target.result;
            if (container) container.style.display = "block";
        }
    };
    reader.readAsDataURL(file);
}
```

**Function 2: Show Detail Pegawai (Update)**
```javascript
window.showDetailPegawai = function (data) {
    // ... field mappings ...

    // Handle Foto
    var fotoImg = document.getElementById("viewFoto");
    var fotoPlaceholder = document.getElementById("viewFotoPlaceholder");

    if (data.viewFoto && fotoImg && fotoPlaceholder) {
        if (data.viewFoto.trim()) {
            fotoImg.src = '/storage/' + data.viewFoto;
            fotoImg.style.display = 'block';
            fotoPlaceholder.style.display = 'none';
        } else {
            fotoImg.style.display = 'none';
            fotoPlaceholder.style.display = 'flex';
            // Extract initials
            var nama = data.viewNama || '?';
            var initials = nama.split(' ')
                .map(function (n) { return n[0]; })
                .join('')
                .substring(0, 2)
                .toUpperCase();
            fotoPlaceholder.textContent = initials || '?';
        }
    }

    openModal("modalViewPegawai");
};
```

**Event Listener (DOMContentLoaded):**
```javascript
document.addEventListener("DOMContentLoaded", function () {
    // Photo preview for Add Employee modal
    var fotoInput = document.getElementById("fotoInputAdd");
    if (fotoInput) {
        fotoInput.addEventListener("change", function (e) {
            handlePhotoPreview(e, "fotoPreviewAdd", "fotoPreviewImg");
        });
    }
});
```

---

## 🎯 FILE YANG DIMODIFIKASI/DIBUAT

### File Baru:
1. **`public/css/theme-green.css`** - CSS override untuk tema hijau profesional (600+ baris)

### File Dimodifikasi:
1. **`app/Models/Employees.php`** - Tambah kolom `foto` ke `$fillable`
2. **`app/Http/Controllers/DataMasterController.php`** - Update `dataPegawaiInsert()` & `dataPegawaiUpdate()`
3. **`resources/views/layouts/layout-admin.blade.php`** - Link CSS theme-green.css
4. **`resources/views/components/modal-layout/modal-data-pegawai.blade.php`** - Update form upload, modal view, styling
5. **`resources/views/data-pegawai.blade.php`** - Tambah kolom avatar, pass viewFoto
6. **`public/js/app.js`** - Update showDetailPegawai(), tambah handlePhotoPreview()

---

## 🚀 CARA MENGGUNAKAN

### 1. Upload Foto saat Tambah Pegawai
1. Klik tombol "Tambah Pegawai"
2. Pilih file foto (JPG/PNG, max 2MB)
3. Preview akan terlihat otomatis
4. Lanjutkan isi form lainnya
5. Submit form

### 2. Upload Foto saat Edit Pegawai
1. Klik tombol edit pada tabel
2. Modal edit akan terbuka
3. Pilih file foto baru (opsional)
4. Submit untuk simpan perubahan
5. Foto lama akan dihapus otomatis

### 3. Lihat Foto di Tabel
- Kolom FOTO menampilkan avatar 36x36px
- Jika ada foto: tampilkan gambar
- Jika tidak ada: tampilkan inisial 2 huruf pertama nama

### 4. Lihat Foto di Modal Detail
- Klik tombol "eye" untuk lihat detail
- Foto akan ditampilkan 80x80px di atas modal
- Dengan border hijau untuk styling profesional

---

## 📁 STRUKTUR PENYIMPANAN FILE

```
storage/
└── app/
    └── public/
        └── foto_pegawai/
            ├── 1713014400_507a8c2d1234f.jpg
            ├── 1713014420_507a8c2d5678a.png
            └── ...
```

**Akses di frontend:**
```blade
<img src="{{ asset('storage/foto_pegawai/1713014400_507a8c2d1234f.jpg') }}" />
<!-- atau -->
<img src="/storage/foto_pegawai/1713014400_507a8c2d1234f.jpg" />
```

---

## ⚙️ KONFIGURASI

### Laravel Storage Disk
Pastikan `config/filesystems.php` memiliki:
```php
'public' => [
    'driver' => 'local',
    'root'   => storage_path('app/public'),
    'url'    => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### Symlink (Jika belum dibuat)
```bash
php artisan storage:link
```

---

## ✅ TESTING CHECKLIST

- [ ] Upload foto saat tambah pegawai
- [ ] Preview foto muncul sebelum submit
- [ ] Validasi tipe file (hanya JPG/PNG)
- [ ] Validasi ukuran file (max 2MB)
- [ ] Foto tersimpan di storage/app/public/foto_pegawai/
- [ ] Avatar ditampilkan di tabel
- [ ] Inisial ditampilkan jika tidak ada foto
- [ ] Foto ditampilkan di modal detail
- [ ] Edit pegawai + ganti foto
- [ ] Foto lama dihapus saat upload foto baru
- [ ] Tema hijau ditampilkan dengan benar
- [ ] Sidebar hijau gelap
- [ ] Cards putih dengan border ringan
- [ ] Buttons hijau dengan hover
- [ ] Forms dengan focus hijau

---

## 🐛 TROUBLESHOOTING

### Foto tidak tersimpan
- [ ] Pastikan folder `storage/app/public/` punya write permission
- [ ] Jalankan `php artisan storage:link` untuk create symlink
- [ ] Check `APP_URL` di `.env`

### Preview tidak muncul
- [ ] Buka browser console untuk lihat error
- [ ] Pastikan file `public/js/app.js` sudah di-update
- [ ] Check ID element: `fotoInputAdd`, `fotoPreviewAdd`, `fotoPreviewImg`

### Tema hijau tidak muncul
- [ ] Pastikan `theme-green.css` sudah di-link di layout
- [ ] Clear browser cache (Ctrl+Shift+Del)
- [ ] Check urutan link CSS (theme-green.css harus setelah components.css)

### Validasi file gagal di server
- [ ] Check validasi di controller: `mimes:jpg,jpeg,png|max:2048`
- [ ] Pastikan MIME types terdaftar di server
- [ ] Check error message di response

---

## 📞 SUPPORT & NOTES

**Catatan Penting:**
1. Semua styling menggunakan CSS variables untuk kemudahan maintenance
2. Foto bersifat nullable - pegawai tanpa foto tetap bisa disimpan
3. Validasi dilakukan di client (JS) dan server (Laravel)
4. Inisial avatar diambil dari 2 huruf pertama nama lengkap
5. Path foto disimpan relatif dari `storage/` untuk portabilitas

**Saran Improvement:**
- Tambah fitur crop foto saat upload
- Compress foto otomatis sebelum simpan
- Tambah fitur delete foto dari detail pegawai
- Backup foto secara berkala

---

**Dokumentasi dibuat:** 2026-04-13  
**Versi:** 1.0 Stabil  
**Developer:** Claude AI Assistant
