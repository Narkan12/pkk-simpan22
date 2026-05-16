{{-- Header --}}
<header id="topHeader" class="top-header">

    {{-- Kiri: Toggle + Judul --}}
    <div class="header-left">
        <button id="headerToggleBtn" onclick="toggleSidebar()" class="header-toggle-btn">
            <i class="bi bi-list"></i>
        </button>
        <div class="header-breadcrumb">
            <span class="header-breadcrumb-sub">Dashboard / {{ $slot }}</span>
            <h2 class="header-breadcrumb-title">{{ $slot }}</h2>
        </div>
    </div>

    {{-- Kanan: Jam --}}
    <div class="header-right">
        <span class="header-clock">
            <i class="bi bi-clock" style="margin-right:4px;"></i>
            <span id="currentTime">00:00:00</span>
        </span>
    </div>

</header>

<style>
@media (max-width: 767px) {
    #headerToggleBtn {
        display: none !important;
    }
}
</style>