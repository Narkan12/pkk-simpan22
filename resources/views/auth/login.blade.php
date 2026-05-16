<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAN - Login</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>

<body class="login-body">

    <div class="login-card zoom-in">

        {{-- FORM LOGIN - Bagian Kiri --}}
        <div class="login-left">

            <h1 class="login-title">SELAMAT DATANG!</h1>
            <p class="login-subtitle">Silahkan masukan data anda</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="field-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="bi bi-person-fill"></i></span>
                        <input type="email" id="email" name="email" placeholder="Masukan Email Anda"
                            class="input-field" value="{{ old('email') }}" required>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="field-label">Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="bi bi-key"></i></span>
                        <input type="password" id="password" name="password" placeholder="Masukan Password Anda"
                            class="input-field" required>
                        <button type="button" id="togglePassword" class="toggle-btn">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Check Box & Lupa Password --}}
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
                    <label class="login-remember">
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">MASUK</button>

            </form>
        </div>

        {{-- BAGIAN KANAN : Identitas --}}
        <div class="login-right">
            <div class="brand-circle"></div>
            <div class="text-center relative z-10">
                <h2 class="brand-title">SIMPAN</h2>
                <p class="brand-subtitle">SISTEM INFORMASI KEPEGAWAIAN</p>
                <div class="flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
                </div>
                <p class="brand-tagline">Your Privacy is Safe!</p>
            </div>
        </div>

    </div>

    <div id="loginData"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        class="hidden">
    </div>

    {{-- Modal Login Berhasil --}}
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

    {{-- Modal Login Gagal --}}
    <div id="modalLoginError" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.5);">
        <div style="background:#fff;border-radius:1rem;box-shadow:0 10px 25px rgba(0,0,0,0.15);padding:2rem;width:320px;text-align:center;">
            <div style="display:flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:50%;background:#fee2e2;margin:0 auto 1rem;">
                <i class="bi bi-x-lg" style="font-size:1.5rem;color:#ef4444;"></i>
            </div>
            <h3 style="font-size:1rem;font-weight:600;color:#1f2937;margin-bottom:0.25rem;">Login Gagal</h3>
            <p style="font-size:0.875rem;color:#6b7280;margin-bottom:1.25rem;">Email atau password yang kamu masukkan salah.</p>
            <button onclick="closeLoginModal()" style="width:100%;padding:0.5rem;border-radius:0.5rem;background:#ef4444;color:#fff;font-size:0.875rem;font-weight:500;border:none;cursor:pointer;transition:background 0.2s;">
                Coba Lagi
            </button>
        </div>
    </div>

</body>

</html>
