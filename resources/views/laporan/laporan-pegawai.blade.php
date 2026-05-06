@extends('layouts.layout-admin')

@section('title', 'Laporan Data Pegawai')

@section('content')

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;">
        <h2 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">Laporan Data Pegawai</h2>
        <a href="{{ route('laporan.exportPegawai') }}"
           style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;background:#16a34a;text-decoration:none;">
            <i class="bi bi-download"></i> Ekspor CSV
        </a>
    </div>

    {{-- Cards --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;"><i class="bi bi-people" style="color:#60a5fa;margin-right:0.25rem;"></i> Total Pegawai</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $total }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Pegawai Aktif</p>
            <h3 style="color:#22c55e;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $aktif }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Non-Aktif / Lainnya</p>
            <h3 style="color:#f87171;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $nonAktif }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Total Departemen</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $totalDept }}</h3>
        </div>
    </div>

    {{-- Search --}}
    <div class="search-wrapper" style="margin-top:1rem;">
        <i class="bi bi-search"></i>
        <input type="text" id="cari-laporan-pegawai" placeholder="Cari nama, NIP, jabatan...">
    </div>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="cari-laporan-pegawai">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>NAMA LENGKAP</th>
                    <th>JABATAN</th>
                    <th>DEPARTEMEN</th>
                    <th>TANGGAL MASUK</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $p)
                    @php
                        $statusName = optional($p->status)->nama_status ?? '-';
                        $badge = match(strtolower($statusName)) {
                            'aktif'              => 'status-active',
                            'cuti'               => 'status-cuti',
                            'non-aktif','nonaktif' => 'status-nonaktif',
                            'pensiun'            => 'status-pensiun',
                            'kontrak'            => 'status-kontrak',
                            default              => 'status-lainnya',
                        };
                    @endphp
                    <tr>
                        <td>{{ $p->NIP }}</td>
                        <td style="font-weight:600;color:#fff;">{{ $p->nama_lengkap }}</td>
                        <td>{{ optional($p->jabatan)->nama_jabatan ?? '-' }}</td>
                        <td><span class="status-departemen">{{ optional($p->departemen)->nama_departemen ?? '-' }}</span></td>
                        <td>{{ $p->tanggal_masuk ? \Carbon\Carbon::parse($p->tanggal_masuk)->format('d M Y') : '-' }}</td>
                        <td><span class="{{ $badge }}">{{ $statusName }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:2rem;color:#8b949e;">Belum ada data pegawai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
