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

        <x-sidebar-active href="{{ route('dashboard') }}"    icon="bi-house"   route="dashboard">Beranda</x-sidebar-active>
        <x-sidebar-active href="{{ route('data-pegawai') }}" icon="bi-people"  route="data-pegawai">Data Pegawai</x-sidebar-active>

        {{-- Data Master --}}
        @php $dmActive = request()->routeIs(['jabatan','departemen','status','golongan','pendidikan','komponen-gaji']); @endphp
        <button onclick="toggleDropdown('menuDataMaster', this)" class="nav-item w-full {{ $dmActive ? 'active' : '' }}">
            <i class="bi bi-database nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Data Master</span>
            <i class="bi bi-chevron-{{ $dmActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuDataMaster" class="{{ $dmActive ? '' : 'hidden' }} sidebar-dropdown-panel">
            <x-sidebar-active href="{{ route('jabatan') }}"       icon="bi-briefcase"   route="jabatan"       :dropdown="true">Jabatan</x-sidebar-active>
            <x-sidebar-active href="{{ route('departemen') }}"    icon="bi-diagram-3"   route="departemen"    :dropdown="true">Departemen</x-sidebar-active>
            <x-sidebar-active href="{{ route('status') }}"        icon="bi-toggle-on"   route="status"        :dropdown="true">Status</x-sidebar-active>
            <x-sidebar-active href="{{ route('golongan') }}"      icon="bi-layers"      route="golongan"      :dropdown="true">Golongan</x-sidebar-active>
            <x-sidebar-active href="{{ route('pendidikan') }}"    icon="bi-mortarboard" route="pendidikan"    :dropdown="true">Pendidikan</x-sidebar-active>
            <x-sidebar-active href="{{ route('komponen-gaji') }}" icon="bi-coin"        route="komponen-gaji" :dropdown="true">Komponen Gaji</x-sidebar-active>
        </div>

        {{-- Operasional --}}
        @php $opActive = request()->routeIs(['absensi','manajemen-cuti','manajemen-gaji']); @endphp
        <button onclick="toggleDropdown('menuOperasional', this)" class="nav-item w-full {{ $opActive ? 'active' : '' }}">
            <i class="bi bi-gear nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Operasional</span>
            <i class="bi bi-chevron-{{ $opActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuOperasional" class="{{ $opActive ? '' : 'hidden' }} sidebar-dropdown-panel">
            <x-sidebar-active href="{{ route('absensi') }}"        icon="bi-calendar-check"    route="absensi"        :dropdown="true">Absensi</x-sidebar-active>
            <x-sidebar-active href="{{ route('manajemen-cuti') }}" icon="bi-file-earmark-text" route="manajemen-cuti" :dropdown="true">Cuti</x-sidebar-active>
            <x-sidebar-active href="{{ route('manajemen-gaji') }}" icon="bi-cash-stack"        route="manajemen-gaji" :dropdown="true">Gaji</x-sidebar-active>
        </div>

        {{-- Laporan --}}
        @php $lapActive = request()->routeIs(['ekspor-data','laporan-pegawai','laporan-gaji','laporan-cuti','laporan-jabatan']); @endphp
        <button onclick="toggleDropdown('menuLaporan', this)" class="nav-item w-full {{ $lapActive ? 'active' : '' }}">
            <i class="bi bi-bar-chart nav-icon"></i>
            <span class="sidebar-text" style="margin-left:0.75rem;flex:1;text-align:left;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">Laporan</span>
            <i class="bi bi-chevron-{{ $lapActive ? 'up' : 'down' }} sidebar-text" style="font-size:11px;flex-shrink:0;transition:transform 0.2s;"></i>
        </button>
        <div id="menuLaporan" class="{{ $lapActive ? '' : 'hidden' }} sidebar-dropdown-panel">
            <x-sidebar-active href="{{ route('ekspor-data') }}"     icon="bi-download"          route="ekspor-data"     :dropdown="true">Ekspor Data</x-sidebar-active>
            <x-sidebar-active href="{{ route('laporan-pegawai') }}" icon="bi-person-lines-fill" route="laporan-pegawai" :dropdown="true">Laporan Pegawai</x-sidebar-active>
            <x-sidebar-active href="{{ route('laporan-gaji') }}"    icon="bi-cash-coin"         route="laporan-gaji"    :dropdown="true">Laporan Gaji</x-sidebar-active>
            <x-sidebar-active href="{{ route('laporan-cuti') }}"    icon="bi-calendar2-minus"   route="laporan-cuti"    :dropdown="true">Laporan Cuti</x-sidebar-active>
            <x-sidebar-active href="{{ route('laporan-jabatan') }}" icon="bi-briefcase"         route="laporan-jabatan" :dropdown="true">Laporan Jabatan</x-sidebar-active>
        </div>

    </nav>

    {{-- User Profile --}}
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">A</div>
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
