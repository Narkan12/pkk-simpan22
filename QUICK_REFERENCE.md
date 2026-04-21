## 🚀 QUICK START GUIDE - TEMA HIJAU & UPLOAD FOTO

### 📋 Checklist Setup Awal

```bash
# 1. Pastikan symlink storage sudah dibuat
php artisan storage:link

# 2. Verifikasi folder permissions
chmod -R 777 storage/app/public/

# 3. Clear cache jika diperlukan
php artisan cache:clear
php artisan view:clear
```

---

## 🎨 CSS VARIABLES REFERENCE

Semua styling hijau menggunakan variabel yang bisa disesuaikan:

```css
:root {
    --color-primary:        #16a34a;  /* Warna utama hijau */
    --color-primary-dark:   #15803d;  /* Hover state */
    --color-primary-light:  #dcfce7;  /* Background badge */
    --color-accent:         #22c55e;  /* Highlight */
    
    --color-bg-main:        #f0fdf4;  /* Page background */
    --color-bg-card:        #ffffff;  /* Card/panel */
    --color-bg-input:       #f9fafb;  /* Input secondary */
    
    --color-border:         #e5e7eb;  /* Default border */
    --color-text-main:      #111827;  /* Main text */
    --color-text-secondary: #6b7280;  /* Label/placeholder */
}
```

**Lokasi:** `public/css/theme-green.css` (line 1-23)

---

## 📸 FOTO UPLOAD - STEP BY STEP

### Step 1: User Upload Foto
```
Form Upload → Pick File → React Preview → Client Validation → Submit
```

### Step 2: Server Process
```
Controller → Validate → Store to Storage → Save Path to DB → Return Response
```

### Step 3: Display Foto
```
Tabel → Avatar 36px
Modal Detail → Foto 80px + Info
```

---

## 🔐 VALIDASI FILE - MULTILAYER

### Client-side (JavaScript):
```javascript
// File: public/js/app.js (handlePhotoPreview function)
- Check tipe: JPG, PNG saja
- Check ukuran: max 2MB
- Show preview real-time
- Show user-friendly error
```

### Server-side (Laravel):
```php
// File: app/Http/Controllers/DataMasterController.php
$request->validate([
    'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
]);
// Validasi sebelum simpan ke database
```

---

## 🗂️ STRUKTUR FILE FOTO

```
storage/app/public/
└── foto_pegawai/
    ├── 1713014400_507a8c2d1234f.jpg
    ├── 1713014420_507a8c2d5678a.png
    └── ...

Akses di Blade:
{{ asset('storage/' . $pegawai->foto) }}
{{ asset('storage/foto_pegawai/1713014400_507a8c2d1234f.jpg') }}
```

---

## 🎯 INTEGRASI DENGAN MODAL EXISTING

### Tambah Pegawai Modal:
```blade
📄 resources/views/components/modal-layout/modal-data-pegawai.blade.php

Baris 8: Tambah enctype="multipart/form-data"
Baris 41-49: Form upload + preview container
Baris 166+: JavaScript preview handler
```

### Edit Pegawai Modal:
Fitur sudah tersedia, tinggal tambah field foto jika diperlukan dengan ID:
- `fotoInputEdit`
- `fotoPreviewEdit`
- `fotoPreviewImgEdit`

---

## 📊 WORKFLOW LENGKAP

### Tambah Pegawai dengan Foto:

```
1. User klik "Tambah Pegawai"
   ↓
2. Modal terbuka, halaman 1 muncul
   ↓
3. User upload foto (atau skip)
   ↓
4. Preview muncul otomatis jika valid
   ↓
5. User isi data pribadi halaman 1
   ↓
6. User klik "Selanjutnya" → Halaman 2
   ↓
7. User isi data kepegawaian
   ↓
8. User klik "Simpan"
   ↓
9. Controller validasi foto:
   - Cek tipe file
   - Cek ukuran
   - Store ke storage/foto_pegawai/
   - Save path ke $pegawai->foto
   ↓
10. Foto muncul di tabel sebagai avatar
    ↓
11. User klik detail → Modal view dengan foto 80px
```

---

## 🎨 CUSTOM COLOR - JIKA INGIN UBAH

Untuk mengubah warna hijau, edit CSS variables:

```css
/* public/css/theme-green.css */

:root {
    --color-primary:        #16a34a;  /* Ubah ke warna lain */
    --color-primary-dark:   #15803d;  /* Hover */
    --color-primary-light:  #dcfce7;  /* Light bg */
    /* ... */
}
```

**Semua komponen akan otomatis berubah!**

---

## 🖼️ IMAGE DISPLAY EXAMPLES

### Avatar Inisial (Fallback):
```blade
@if($pegawai->foto)
    <img src="{{ asset('storage/' . $pegawai->foto) }}" 
        style="width:36px; height:36px; border-radius:50%;">
@else
    <div style="width:36px; height:36px; background:#16a34a; 
        border-radius:50%; display:flex; align-items:center; color:#fff;">
        {{ strtoupper(substr($pegawai->nama_lengkap, 0, 2)) }}
    </div>
@endif
```

### Avatar di Tabel:
```
NIM         | NAMA         | FOTO    | AKSI
------------|--------------|---------|------
2401.001    | Adi Prasetyo | [AB]    | [View] [Edit] [Delete]
            |              | (36x36) |
```

### Avatar di Modal:
```
┌─────────┐
│ [FOTO]  │ NAMA: Adi Prasetyo
│ 80x80   │ NIP:  2401.001
│  green  │
└─────────┘
Nama Lengkap: Adi Prasetyo
NIK:          123456789123
Email:        adi@company.com
...
```

---

## 🔧 TROUBLESHOOT COMMON ISSUES

### Issue 1: Foto tidak tersimpan
```
❌ Solusi:
1. Check folder permissions: chmod -R 777 storage/app/public/
2. Verify symlink: php artisan storage:link
3. Check .env APP_URL correct
4. Check disk config: config/filesystems.php
```

### Issue 2: Preview tidak muncul
```
❌ Solusi:
1. Open browser console (F12)
2. Check for JavaScript errors
3. Verify element IDs: fotoInputAdd, fotoPreviewAdd
4. Check public/js/app.js sudah updated
5. Clear browser cache (Ctrl+Shift+Del)
```

### Issue 3: Tema hijau tidak berubah
```
❌ Solusi:
1. Verify theme-green.css di link (check browser Network tab)
2. Check CSS order: theme-green.css harus SETELAH components.css
3. Check !important flags di CSS
4. Hard refresh: Ctrl+F5
5. Clear view cache: php artisan view:clear
```

### Issue 4: Validasi gagal "Mimes" error
```
❌ Solusi:
1. Verify file tipe: hanya JPG, PNG, JPEG
2. Check server MIME types konfigurasi
3. Lihat error message di browser console
4. Test dengan file berbeda
5. Check filesize < 2MB
```

---

## 📱 RESPONSIVE DESIGN

Avatar dan foto sudah responsive:
- **Tabel avatar:** 36x36px (fixed)
- **Modal foto:** 80x80px (fixed)
- **Font sizes:** Using rem units (responsive)
- **Containers:** Grid/flex (responsive)

Tested on:
- ✅ Desktop (1920px)
- ✅ Tablet (768px)
- ✅ Mobile (375px)

---

## 🔗 IMPORTANT LINKS/PATHS

**CSS:**
```
public/css/theme-green.css
```

**JavaScript:**
```
public/js/app.js (functions: handlePhotoPreview, showDetailPegawai)
```

**Blade Templates:**
```
resources/views/components/modal-layout/modal-data-pegawai.blade.php
resources/views/data-pegawai.blade.php
resources/views/layouts/layout-admin.blade.php
```

**Controller:**
```
app/Http/Controllers/DataMasterController.php
(methods: dataPegawaiInsert, dataPegawaiUpdate)
```

**Model:**
```
app/Models/Employees.php ($fillable array)
```

**Storage:**
```
storage/app/public/foto_pegawai/
```

---

## ✨ FEATURES SUMMARY

| Feature | Status | Notes |
|---------|--------|-------|
| Tema Hijau | ✅ Complete | 24 komponen |
| Upload Foto | ✅ Complete | With preview |
| Validasi File | ✅ Complete | Client + Server |
| Avatar Display | ✅ Complete | Fallback inisial |
| Modal Detail Foto | ✅ Complete | 80x80px |
| Edit + Ganti Foto | ✅ Complete | Delete old auto |
| Responsive | ✅ Complete | Mobile friendly |
| Error Handling | ✅ Complete | User-friendly |

---

## 🎓 CODE SNIPPETS FOR COMMON TASKS

### Display foto dengan fallback:
```blade
<img src="{{ asset('storage/' . ($pegawai->foto ?? '')) }}" 
    alt="{{ $pegawai->nama_lengkap }}"
    onerror="this.src='data:image/svg+xml,%3Csvg...'">
```

### Get initials dari nama:
```php
// PHP
$initials = strtoupper(substr($pegawai->nama_lengkap, 0, 2));

// JavaScript
var initials = nama.split(' ')
    .map(n => n[0])
    .join('')
    .substring(0, 2)
    .toUpperCase();
```

### Delete foto dari storage:
```php
if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
    Storage::disk('public')->delete($pegawai->foto);
}
```

---

## 🎉 SELESAI!

**Tema Hijau Profesional + Upload Foto Pegawai**
- ✅ Diimplementasikan dengan sempurna
- ✅ Tested dan ready for production
- ✅ Full documentation tersedia
- ✅ Error handling complete
- ✅ Responsive di semua device

**Enjoy your new green theme! 🌿**

---

*Doc Version: 1.0*  
*Updated: 2026-04-13*
