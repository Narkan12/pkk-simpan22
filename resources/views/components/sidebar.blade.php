

{{-- Dark Overlay (mobile only) --}}
<div id="sidebarOverlay" onclick="closeMobileSidebar()"
    style="display:none;position:fixed;inset:0;z-index:149;background:rgba(0,0,0,0.5);"></div>

{{-- Sidebar --}}
<aside id="sidebar" class="sidebar" data-expanded="true">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <div class="sidebar-logo-circle">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="sidebar-text sidebar-logo-text">
            <div class="sidebar-logo-name">SIMPAN</div>
            <div class="sidebar-logo-role">Panel Admin</div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="sidebar-nav">

        {{-- Beranda: semua role --}}
        <x-sidebar-active href="{{ route('dashboard') }}" icon="bi-house" route="dashboard"
            onclick="closeMobileSidebarOnNav()">Beranda</x-sidebar-active>

        {{-- Data Pegawai: semua role --}}
        <x-sidebar-active href="{{ route('data-pegawai') }}" icon="bi-people" route="data-pegawai"
            onclick="closeMobileSidebarOnNav()">Data Pegawai</x-sidebar-active>

            {{-- Manajemen HRD: admin dan owner saja --}}
        @if(in_array(auth()->user()->role ?? '', ['admin', 'owner']))
            <x-sidebar-active href="{{ route('manajemen-hrd') }}" icon="bi-person-badge" route="manajemen-hrd"
                onclick="closeMobileSidebarOnNav()">Manajemen HRD</x-sidebar-active>
        @endif

        {{-- Data Master: owner dan admin saja, HRD tidak bisa lihat --}}
        @if(in_array(auth()->user()->role ?? '', ['admin', 'owner']))
            @php $dmActive = request()->routeIs(['jabatan','departemen','status','golongan','pendidikan','komponen-gaji']); @endphp
            <button onclick="toggleDropdown('menuDataMaster', this)" class="nav-item w-full {{ $dmActive ? 'active' : '' }}">
                <i class="bi bi-database nav-icon"></i>
                <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Data Master</span>
                <i class="bi bi-chevron-{{ $dmActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
            </button>
            <div id="menuDataMaster" class="{{ $dmActive ? '' : 'hidden' }} sidebar-dropdown-panel">
                <x-sidebar-active href="{{ route('jabatan') }}"       icon="bi-briefcase"   route="jabatan"       :dropdown="true" onclick="closeMobileSidebarOnNav()">Jabatan</x-sidebar-active>
                <x-sidebar-active href="{{ route('departemen') }}"    icon="bi-diagram-3"   route="departemen"    :dropdown="true" onclick="closeMobileSidebarOnNav()">Departemen</x-sidebar-active>
                <x-sidebar-active href="{{ route('status') }}"        icon="bi-toggle-on"   route="status"        :dropdown="true" onclick="closeMobileSidebarOnNav()">Status</x-sidebar-active>
                <x-sidebar-active href="{{ route('golongan') }}"      icon="bi-layers"      route="golongan"      :dropdown="true" onclick="closeMobileSidebarOnNav()">Golongan</x-sidebar-active>
                <x-sidebar-active href="{{ route('pendidikan') }}"    icon="bi-mortarboard" route="pendidikan"    :dropdown="true" onclick="closeMobileSidebarOnNav()">Pendidikan</x-sidebar-active>
                <x-sidebar-active href="{{ route('komponen-gaji') }}" icon="bi-coin"        route="komponen-gaji" :dropdown="true" onclick="closeMobileSidebarOnNav()">Komponen Gaji</x-sidebar-active>
            </div>
        @endif

        

        {{-- Operasional: semua role --}}
        @php $opActive = request()->routeIs(['absensi','manajemen-cuti','manajemen-gaji']); @endphp
        <button onclick="toggleDropdown('menuOperasional', this)" class="nav-item w-full {{ $opActive ? 'active' : '' }}">
            <i class="bi bi-gear nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Operasional</span>
            <i class="bi bi-chevron-{{ $opActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuOperasional" class="{{ $opActive ? '' : 'hidden' }} sidebar-dropdown-panel">
            <x-sidebar-active href="{{ route('absensi') }}"        icon="bi-calendar-check"    route="absensi"        :dropdown="true" onclick="closeMobileSidebarOnNav()">Absensi</x-sidebar-active>
            <x-sidebar-active href="{{ route('manajemen-cuti') }}" icon="bi-file-earmark-text" route="manajemen-cuti" :dropdown="true" onclick="closeMobileSidebarOnNav()">Cuti</x-sidebar-active>
            <x-sidebar-active href="{{ route('manajemen-gaji') }}" icon="bi-cash-stack"        route="manajemen-gaji" :dropdown="true" onclick="closeMobileSidebarOnNav()">Gaji</x-sidebar-active>
        </div>

        {{-- Laporan --}}
        @php
            $lapActive = request()->routeIs(['ekspor-data','laporan-pegawai','laporan-gaji','laporan-cuti','laporan-jabatan']);
            $role = auth()->user()->role ?? '';
        @endphp
        <button onclick="toggleDropdown('menuLaporan', this)" class="nav-item w-full {{ $lapActive ? 'active' : '' }}">
            <i class="bi bi-bar-chart nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Laporan</span>
            <i class="bi bi-chevron-{{ $lapActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuLaporan" class="{{ $lapActive ? '' : 'hidden' }} sidebar-dropdown-panel">

            {{-- Ekspor Data: semua role  --}}
                <x-sidebar-active href="{{ route('ekspor-data') }}" icon="bi-download" route="ekspor-data" :dropdown="true" onclick="closeMobileSidebarOnNav()">Ekspor Data</x-sidebar-active>

            {{-- Laporan Pegawai: semua role --}}
            <x-sidebar-active href="{{ route('laporan-pegawai') }}" icon="bi-person-lines-fill" route="laporan-pegawai" :dropdown="true" onclick="closeMobileSidebarOnNav()">Laporan Pegawai</x-sidebar-active>

            {{-- Laporan Gaji: semua role --}}
            <x-sidebar-active href="{{ route('laporan-gaji') }}" icon="bi-cash-coin" route="laporan-gaji" :dropdown="true" onclick="closeMobileSidebarOnNav()">Laporan Gaji</x-sidebar-active>

            {{-- Laporan Cuti: semua role --}}
            <x-sidebar-active href="{{ route('laporan-cuti') }}" icon="bi-calendar2-minus" route="laporan-cuti" :dropdown="true" onclick="closeMobileSidebarOnNav()">Laporan Cuti</x-sidebar-active>

            {{-- Laporan Jabatan --}}
           
                <x-sidebar-active href="{{ route('laporan-jabatan') }}" icon="bi-briefcase" route="laporan-jabatan" :dropdown="true" onclick="closeMobileSidebarOnNav()">Laporan Jabatan</x-sidebar-active>

        </div>

    </nav>

    {{-- User Profile --}}
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}</div>
        <div class="sidebar-text sidebar-user-info">
            <div class="sidebar-user-name">{{ auth()->user()->username ?? 'Nama Pengguna' }}</div>
            <div class="sidebar-user-email">{{ auth()->user()->email ?? 'pengguna@email.com' }}</div>
        </div>
    </div>

    {{-- Logout --}}
    <button type="button" onclick="openLogoutModal()" class="nav-item" style="border-top:1px solid var(--green-medium);flex-shrink:0;width:100%;text-align:left;color:#C62828;">
        <i class="bi bi-box-arrow-right nav-icon"></i>
        <span class="sidebar-text" style="margin-left:0.75rem;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Keluar</span>
    </button>

</aside>

{{-- Mobile Sidebar CSS + JS --}}
<style>
@media (max-width: 767px) {
    #sidebarToggleBtn { display: block !important; }

    #sidebar {
        position: fixed !important;
        left: -220px !important;
        top: 0 !important;
        height: 100vh !important;
        z-index: 150 !important;
        transition: left 0.3s ease !important;
        width: 210px !important;
    }

    #sidebar.mobile-open {
        left: 0 !important;
    }

    #sidebarOverlay.mobile-open {
        display: block !important;
    }

    #mainContent, #topHeader {
        margin-left: 0 !important;
        left: 0 !important;
    }
}
</style>

<script>
function openMobileSidebar() {
    document.getElementById('sidebar').classList.add('mobile-open');
    document.getElementById('sidebarOverlay').classList.add('mobile-open');
    document.body.style.overflow = 'hidden';
}

function closeMobileSidebar() {
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('sidebarOverlay').classList.remove('mobile-open');
    document.body.style.overflow = '';
}

// Tutup sidebar saat klik menu item di mobile
function closeMobileSidebarOnNav() {
    if (window.innerWidth < 768) {
        closeMobileSidebar();
    }
}
</script>
