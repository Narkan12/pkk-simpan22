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

    <x-modal-layout.modal-login></x-modal-layout.modal-login>

</body>

</html>
