<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="/js/app.js" defer></script>
</head>

<body class="layout-pegawai-body">

    <!-- Navbar -->
    <nav class="pegawai-navbar">

    <!-- KIRI: Logo + Nama -->
    <div class="d-flex align-center" style="gap:0.5rem;">
        <img src="{{ asset('images/logo.png') }}" alt="" style="width:32px;">
        <span class="text-white font-bold tracking-widest" style="font-size:0.875rem;letter-spacing:0.1em;font-weight:700;color:#fff;">
            SIMPAN
        </span>
    </div>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-item" style="border-top:1px solid #1a1a1a;flex-shrink:0;">
            <i class="bi bi-box-arrow-right nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;">Keluar</span>
        </button>
    </form>

</nav>

    <!-- Content -->
    <main class="pegawai-main">
        @yield('content')
    </main>

    @yield('modal')

    {{-- Notifikasi toast global --}}
    @include('components.notifikasi-toast')

</body>
</html>