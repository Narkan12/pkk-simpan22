<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAN - Sistem Informasi Manajemen Pegawai</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="overflow-x:hidden;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">

    {{-- Navbar Section --}}
    <nav class="navbar" style="background:linear-gradient(to bottom, rgba(45,122,62,0.88), rgba(30,91,46,0.88));">
        <div class="navbar-inner">
            <div class="navbar-left">
                <a href="#" class="nav-link">Beranda</a>
                <a href="#tentang" class="nav-link">Tentang Kami</a>
            </div>

            <div class="navbar-center">
                <div class="nav-logo-img">
                    <img src="{{ asset('images/logo.png') }}" class="object-cover" style="width:100%;height:100%;">
                </div>
                <span class="nav-brand">SIMPAN</span>
            </div>

            <div class="navbar-right">
                <a href="#kontak" class="nav-link">Kontak Kami</a>
                <a class="btn-masuk" href="{{ route('login') }}">MASUK</a>
            </div>
        </div>
    </nav>

    {{-- Header Section --}}
    <section style="background:linear-gradient(135deg,#2d7a3e,#1a4d28);min-height:500px;">
        <div class="container-landing">
            <div class="d-flex align-center" style="min-height:600px;">
                <div class="landing-hero-img" style="flex:none;width:35%;display:flex;align-items:flex-end;"
                    data-aos="fade-right" data-aos-duration="1000">
                    <div style="margin-top:6rem;width:400px;height:500px;overflow:hidden;">
                        <img src="{{ asset('images/woman-welcome.png') }}" alt=""
                            style="width:100%;height:100%;object-fit:cover;">
                    </div>
                </div>

                <div class="landing-hero-text" style="flex:1;padding:4rem 5rem 4rem 2.5rem;color:#fff;"
                    data-aos="fade-left" data-aos-duration="1000">
                    <h1 style="font-size:3.5rem;font-weight:700;margin-bottom:1.5rem;letter-spacing:0.025em;">SELAMAT
                        DATANG!</h1>
                    <p style="font-size:1.125rem;line-height:1.625;margin-bottom:2.25rem;max-width:650px;">
                        Sistem Informasi Manajemen Pegawai yang terintegrasi untuk mengelola data kepegawaian secara
                        efisien dan profesional.
                    </p>
                    <div class="d-flex" style="gap:1.25rem;">
                        <a href="#search" class="btn-hero-primary">CARI DATA ANDA</a>
                        <a href="#tentang" class="btn-hero-primary text-white">INFO SELENGKAPNYA >></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section: Tentang Kami --}}
    <section style="padding:4.375rem 0;background:#fff;" id="tentang">
        <div class="container-content">
            <h2 style="text-align:center;font-size:2.5rem;font-weight:700;color:#1e5b2e;margin-bottom:4rem;"
                data-aos="fade-up">Tentang Kami</h2>
            <div class="grid-tentang" style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;">
                <div class="card-tentang" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-tentang-icon">
                        <i class="bi bi-star-fill" style="color:#fff;font-size:2.5rem;"></i>
                    </div>
                    <h3 class="card-tentang-title">VISI SIMPAN</h3>
                    <p class="card-tentang-desc">Mewujudkan system kepegawaian yang kuat, terintegrasi dan akurat.</p>
                </div>
                <div class="card-tentang" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-tentang-icon">
                        <i class="bi bi-shield-fill" style="color:#fff;font-size:2.5rem;"></i>
                    </div>
                    <h3 class="card-tentang-title">MANAJEMEN</h3>
                    <p class="card-tentang-desc">Manajemen berupa pengelolaan, pemeliharaan dan pengorganisasian secara
                        terpusat</p>
                </div>
                <div class="card-tentang" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-tentang-icon">
                        <i class="bi bi-bullseye" style="color:#fff;font-size:2.5rem;"></i>
                    </div>
                    <h3 class="card-tentang-title">MISI SIMPAN</h3>
                    <p class="card-tentang-desc">Memberikan berbagai kemudahan dalam mengelola berbagai data pegawai
                        yang ada</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section : Alur Kerja --}}
    <section style="padding:4rem 0 5rem;background:#f0f5f1;margin-top:6rem;" id="alur">
        <div class="container-content">
            <div style="text-align:center;margin-bottom:3rem;">
                <h2 style="font-size:2.375rem;font-weight:700;color:#1e5b2e;" data-aos="fade-up">Alur Kerja SIMPAN
                </h2>
            </div>

            <div class="alur-wrapper"
                style="display:flex;align-items:stretch;justify-content:center;margin-top:5rem;">
                <div style="display:flex;align-items:center;flex:1;max-width:220px;" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="card-alur">
                        <div class="card-alur-icon" style="background:#4a90d9;">
                            <i class="bi bi-upload" style="color:#fff;font-size:2.125rem;"></i>
                        </div>
                        <h3 class="card-alur-title">Unggah</h3>
                        <p class="card-alur-desc">Unggah dokumen pegawai</p>
                    </div>
                </div>
                <div class="alur-arrow"
                    style="display:flex;align-items:center;justify-content:center;padding:0 0.5rem;font-size:3.125rem;color:#9ca3af;margin-bottom:2rem;"
                    data-aos="fade-in" data-aos-delay="150">→</div>

                <div style="display:flex;align-items:center;flex:1;max-width:220px;" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="card-alur">
                        <div class="card-alur-icon" style="background:#9b59b6;">
                            <i class="bi bi-file-earmark-text" style="color:#fff;font-size:2.125rem;"></i>
                        </div>
                        <h3 class="card-alur-title">Review</h3>
                        <p class="card-alur-desc">Peninjauan data</p>
                    </div>
                </div>
                <div class="alur-arrow"
                    style="display:flex;align-items:center;justify-content:center;padding:0 0.5rem;font-size:3.125rem;color:#9ca3af;margin-bottom:2rem;"
                    data-aos="fade-in" data-aos-delay="250">→</div>

                <div style="display:flex;align-items:center;flex:1;max-width:220px;" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="card-alur">
                        <div class="card-alur-icon" style="background:#27ae60;">
                            <i class="bi bi-person-check" style="color:#fff;font-size:2.125rem;"></i>
                        </div>
                        <h3 class="card-alur-title">Setuju</h3>
                        <p class="card-alur-desc">Persetujuan data</p>
                    </div>
                </div>
                <div class="alur-arrow"
                    style="display:flex;align-items:center;justify-content:center;padding:0 0.5rem;font-size:3.125rem;color:#9ca3af;margin-bottom:2rem;"
                    data-aos="fade-in" data-aos-delay="350">→</div>

                <div style="display:flex;align-items:center;flex:1;max-width:220px;" data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="card-alur">
                        <div class="card-alur-icon" style="background:#e67e22;">
                            <i class="bi bi-database-fill" style="color:#fff;font-size:2.125rem;"></i>
                        </div>
                        <h3 class="card-alur-title">Simpan</h3>
                        <p class="card-alur-desc">Penyimpanan data</p>
                    </div>
                </div>
                <div class="alur-arrow"
                    style="display:flex;align-items:center;justify-content:center;padding:0 0.5rem;font-size:3.125rem;color:#9ca3af;margin-bottom:2rem;"
                    data-aos="fade-in" data-aos-delay="450">→</div>

                <div style="display:flex;align-items:center;flex:1;max-width:220px;" data-aos="fade-up"
                    data-aos-delay="500">
                    <div class="card-alur">
                        <div class="card-alur-icon" style="background:#e74c3c;">
                            <i class="bi bi-bar-chart-fill" style="color:#fff;font-size:2.125rem;"></i>
                        </div>
                        <h3 class="card-alur-title">Laporan</h3>
                        <p class="card-alur-desc">Laporan & Analisis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section : Cari Data --}}
    <section style="padding:4rem 0 5rem;background:#fff;margin-top:6rem;" id="search" data-aos="fade-up"
        data-aos-offset="300">
        <div class="container-search">
            <div style="text-align:center;margin-bottom:3rem;">
                <h2 style="font-size:2.375rem;font-weight:700;color:#1e5b2e;">Cari Data Pegawai</h2>
            </div>
            <div
                style="background:#f5f8f5;border-radius:1rem;padding:2.25rem;width:100%;box-shadow:inset 0 2px 4px rgba(0,0,0,0.06);">
                <form method="POST" action="{{ route('search') }}#search">
                    @csrf
                    <div class="search-form-grid"
                        style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.25rem 2rem;margin-bottom:1.5rem;">
                        <div class="form-group">
                            <label for="nip" class="form-label">Cari Berdasarkan NIP</label>
                            <div class="form-input-wrapper">
                                <i class="bi bi-person form-input-icon"></i>
                                <input type="text" id="nip" name="nip" placeholder="Masukkan NIP"
                                    class="form-input" value="{{ request('nip') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Cari Berdasarkan Nama</label>
                            <div class="form-input-wrapper">
                                <i class="bi bi-search form-input-icon"></i>
                                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama"
                                    class="form-input" value="{{ request('nama') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="departemen" class="form-label">Departemen</label>
                            <select id="departemen" name="departemen" class="form-select">
                                <option value="">Pilih Departemen</option>
                                @foreach ($departemen as $dept)
                                    <option value="{{ $dept->id }}"
                                        {{ request('departemen') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->nama_departemen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select id="jabatan" name="jabatan" class="form-select">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $jab)
                                    <option value="{{ $jab->id }}"
                                        {{ request('jabatan') == $jab->id ? 'selected' : '' }}>
                                        {{ $jab->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex" style="gap:0.875rem;align-items:center;">
                        <button type="submit" class="btn-cari">CARI DATA</button>
                        <a href="{{ route('landing') }}#search" class="btn-reset"
                            style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                            RESET
                        </a>
                    </div>
                </form>
            </div>

            {{-- Hasil Pencarian --}}
            @if (isset($hasil) && count($hasil) > 0)
                <div style="margin-top:3rem;">
                    <h3 style="font-size:1.5rem;font-weight:700;color:#1e5b2e;margin-bottom:1.5rem;">Hasil Pencarian
                        ({{ count($hasil) }} ditemukan)</h3>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
                        @foreach ($hasil as $pegawai)
                            <div
                                style="background:#fff;border-radius:0.75rem;padding:1.5rem;box-shadow:0 4px 6px rgba(0,0,0,0.07);border:1px solid #e5e7eb;transition:box-shadow 0.2s;">
                                <div class="d-flex align-center" style="gap:1rem;margin-bottom:1rem;">
                                    <div class="d-flex align-center justify-center"
                                        style="color:#fff;font-size:1.25rem;font-weight:700;">
                                        {{ strtoupper(substr($pegawai->nama_lengkap, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 style="font-size:1.125rem;font-weight:700;color:#1f2937;">
                                            {{ $pegawai->nama_lengkap }}</h4>
                                        <p style="font-size:0.875rem;color:#6b7280;">NIP: {{ $pegawai->NIP }}</p>
                                    </div>
                                </div>
                                <div style="display:flex;flex-direction:column;gap:0.5rem;font-size:0.875rem;">
                                    <div style="display:flex;justify-content:space-between;">
                                        <span style="color:#4b5563;">Departemen:</span>
                                        <span
                                            style="font-weight:600;color:#1f2937;">{{ $pegawai->departemen->nama_departemen ?? '-' }}</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;">
                                        <span style="color:#4b5563;">Jabatan:</span>
                                        <span
                                            style="font-weight:600;color:#1f2937;">{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;">
                                        <span style="color:#4b5563;">No. Telp:</span>
                                        <span
                                            style="font-weight:600;color:#1f2937;">{{ $pegawai->no_telp ?? '-' }}</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;">
                                        <span style="color:#4b5563;">Alamat:</span>
                                        <span
                                            style="font-weight:600;color:#1f2937;text-align:right;">{{ Str::limit($pegawai->alamat, 30) ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif(isset($hasil) && count($hasil) == 0)
                <div class="alert-warning" style="margin-top:3rem;">
                    <i class="bi bi-search"></i>
                    <p>Tidak ada data pegawai yang ditemukan. Silakan coba pencarian lagi dengan kriteria berbeda.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Content Section : Contact --}}
    <section style="padding:4.375rem 0;background:#f0f5f1;margin-top:5.625rem;" id="kontak">
        <div class="container-content">
            <h2 style="text-align:center;font-size:2.5rem;font-weight:700;color:#1e5b2e;margin-bottom:3rem;"
                data-aos="fade-up">Kontak Kami</h2>
            <div class="grid-kontak" style="display:grid;grid-template-columns:repeat(2,1fr);gap:2.5rem;">
                <div data-aos="fade-right" data-aos-delay="200">
                    <div
                        style="background:#fff;border:1px solid #e5e7eb;border-radius:0.75rem;padding:2.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <h3
                            style="font-size:1.375rem;font-weight:700;color:#1e5b2e;text-align:center;margin-bottom:2rem;">
                            FORM PESAN</h3>
                        <form action="https://formspree.io/f/xreonakn" method="POST">
                            <div style="margin-bottom:1.25rem;">
                                <label
                                    style="display:block;font-size:0.9375rem;font-weight:600;color:#374151;margin-bottom:0.5rem;">Nama
                                    Lengkap</label>
                                <input type="text" name="name" placeholder="*Masukkan Nama Lengkap..."
                                    class="form-kontak-input" required>
                            </div>
                            <div style="margin-bottom:1.25rem;">
                                <label
                                    style="display:block;font-size:0.9375rem;font-weight:600;color:#374151;margin-bottom:0.5rem;">Email</label>
                                <input type="email" name="email" placeholder="*Masukkan Email Anda..."
                                    class="form-kontak-input" required>
                            </div>
                            <div style="margin-bottom:1.25rem;">
                                <label
                                    style="display:block;font-size:0.9375rem;font-weight:600;color:#374151;margin-bottom:0.5rem;">Isi
                                    Pesan</label>
                                <textarea rows="5" name="message" placeholder="*Masukkan Pesan..." class="form-kontak-input"
                                    style="resize:vertical;" required></textarea>
                            </div>
                            <button type="submit" class="btn-kirim">KIRIM PESAN</button>
                        </form>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:1.5rem;" data-aos="fade-left"
                    data-aos-delay="400">
                    <div class="kontak-card">
                        <div class="kontak-card-inner">
                            <div class="kontak-icon"><i class="bi bi-geo-alt-fill" style="color:#fff;"></i></div>
                            <div>
                                <h4 class="kontak-title">ALAMAT</h4>
                                <p class="kontak-text">Jl. Komplek Pemda 2 Lestari Blok C24, Cimahi Selatan</p>
                            </div>
                        </div>
                    </div>
                    <div class="kontak-card">
                        <div class="kontak-card-inner">
                            <div class="kontak-icon"><i class="bi bi-envelope-fill" style="color:#fff;"></i></div>
                            <div>
                                <h4 class="kontak-title">EMAIL</h4>
                                <p class="kontak-text">simpan@data.co.id</p>
                            </div>
                        </div>
                    </div>
                    <div class="kontak-card">
                        <div class="kontak-card-inner">
                            <div class="kontak-icon"><i class="bi bi-telephone-fill" style="color:#fff;"></i></div>
                            <div>
                                <h4 class="kontak-title">NO TELP</h4>
                                <p class="kontak-text">+62 838-1656-3586</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer Section --}}
    <footer class="landing-footer">
        <div class="container-content">
            <div class="footer-grid">
                <!-- Menu -->
                <div>
                    <h5 class="footer-heading">MENU</h5>
                    <ul class="footer-list">
                        <li><a href="#" class="footer-link">Beranda</a></li>
                        <li><a href="#tentang" class="footer-link">Tentang Kami</a></li>
                        <li><a href="#kontak" class="footer-link">Kontak Kami</a></li>
                        <li><a href="#search" class="footer-link">Pencarian Data</a></li>
                    </ul>
                </div>
                <!-- Layanan -->
                <div>
                    <h5 class="footer-heading">LAYANAN</h5>
                    <ul class="footer-list">
                        <li><a href="#" class="footer-link">Absensi Harian</a></li>
                        <li><a href="#" class="footer-link">Data Pegawai</a></li>
                        <li><a href="#" class="footer-link">Laporan Pegawai</a></li>
                    </ul>
                </div>
                <!-- Brand -->
                <div class="footer-brand">
                    <div style="display:flex;flex-direction:column;align-items:center;margin-bottom:1rem;">
                        <div class="footer-brand-logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <h5 class="footer-brand-name">SIMPAN</h5>
                    </div>
                    <p class="footer-brand-desc">
                        Sistem Informasi Manajemen Pegawai yang terintegrasi untuk mengelola data kepegawaian secara
                        efisien dan profesional.
                    </p>
                </div>
            </div>

            <div class="footer-divider"></div>

            <!-- Bottom -->
            <div class="footer-bottom">
                <p class="footer-copy">© 2026 Simpan — Sistem Informasi Kepegawaian</p>
                <div class="footer-socials">
                    <a href="https://wa.me/6283816563586" target="_blank" rel="noopener noreferrer"><img
                            src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp"
                            class="social-icon"></a>
                    <a href="https://www.instagram.com/mewahniagajaya/" target="_blank"
                        rel="noopener noreferrer"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png"
                            alt="Instagram" class="social-icon"></a>
                    <a href="https://web.facebook.com/groups/1541904839368166/" target="_blank"
                        rel="noopener noreferrer"><img src="https://cdn-icons-png.flaticon.com/512/124/124010.png"
                            alt="Facebook" class="social-icon"></a>
                    <a href="https://x.com/BNI" target="_blank" rel="noopener noreferrer"><img
                            src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="LinkedIn"
                            class="social-icon"></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-quad'
        });
    </script>

    {{-- Notifikasi toast — landing page standalone --}}
    @include('components.notifikasi-toast')

</html>


