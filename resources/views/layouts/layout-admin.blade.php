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
    <link rel="stylesheet" href="/css/theme-green.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="page-admin">

    <x-sidebar></x-sidebar>
    <x-header>@yield('title')</x-header>

    <main id="mainContent" class="main-content">
        @yield('content')
    </main>

    {{-- Modal Logout --}}
    <x-modal-layout.modal-logout></x-modal-layout.modal-logout>

    @yield('modal')

    <x-footer></x-footer>

    {{-- Notifikasi toast global — menangkap session sukses/error/warning dan $errors --}}
    @include('components.notifikasi-toast')

    <script src="/js/app.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
