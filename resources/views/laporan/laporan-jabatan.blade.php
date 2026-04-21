@extends('layouts.layout-admin')
@section('title', 'Laporan Jabatan')
@section('content')

    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;">
        <h2 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">Laporan Jabatan</h2>
        <a href="{{ route('laporan.exportJabatan') }}"
           style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;background:#16a34a;text-decoration:none;">
            <i class="bi bi-download"></i> Ekspor Excel
        </a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;"><i class="bi bi-briefcase" style="color:#facc15;margin-right:0.25rem;"></i> Total Jabatan</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $totalJabatan }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Total Pegawai</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $totalPegawai }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Level Tertinggi</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $maxLevel }} Level</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Rata-Rata / Jabatan</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $rataRata }} orang</h3>
        </div>
    </div>

    <div class="search-wrapper" style="margin-top:1rem;">
        <i class="bi bi-search"></i>
        <input type="text" id="cari-laporan-jabatan" placeholder="Cari nama jabatan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="cari-laporan-jabatan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA JABATAN</th>
                    <th>LEVEL</th>
                    <th>JUMLAH PEGAWAI</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th>TOTAL BEBAN GAJI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $j)
                <tr>
                    <td>{{ $j->kode_jabatan }}</td>
                    <td style="font-weight:600;color:#fff;">{{ $j->nama_jabatan }}</td>
                    <td>Level {{ $j->level }}</td>
                    <td><span class="status-belum">{{ $j->employees_count }} orang</span></td>
                    <td>Rp {{ number_format($j->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($j->tunjangan, 0, ',', '.') }}</td>
                    <td style="font-weight:600;color:#fff;">Rp {{ number_format(($j->gaji_pokok + $j->tunjangan) * $j->employees_count, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:#8b949e;">Belum ada data jabatan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
