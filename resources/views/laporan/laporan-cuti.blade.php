@extends('layouts.layout-admin')

@section('title', 'Laporan Cuti')

@section('content')

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;flex-wrap:wrap;gap:0.75rem;">
        <h2 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">Laporan Cuti</h2>
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <select id="filterCutiTahun" class="modal-input" style="width:85px;" onchange="filterCuti()">
                @foreach($tahunList as $t)
                    <option value="{{ $t }}" @if($t == $tahun) selected @endif>{{ $t }}</option>
                @endforeach
            </select>
            <button onclick="eksporCuti()"
                style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;background:#16a34a;cursor:pointer;white-space:nowrap;">
                <i class="bi bi-download"></i> Ekspor Excel
            </button>
        </div>
    </div>

    {{-- Cards --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Total Pengajuan</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $total }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Disetujui</p>
            <h3 style="color:#22c55e;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $disetujui }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Pending</p>
            <h3 style="color:#facc15;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $pending }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Ditolak</p>
            <h3 style="color:#f87171;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $ditolak }}</h3>
        </div>
    </div>

    {{-- Search --}}
    <div class="search-wrapper" style="margin-top:1rem;">
        <i class="bi bi-search"></i>
        <input type="text" id="cari-laporan-cuti" placeholder="Cari nama atau jenis cuti...">
    </div>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="cari-laporan-cuti">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JENIS CUTI</th>
                    <th>TGL MULAI</th>
                    <th>TGL SELESAI</th>
                    <th>DURASI</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $c)
                    @php
                        $durasi = \Carbon\Carbon::parse($c->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($c->tanggal_selesai)) + 1;
                    @endphp
                    <tr>
                        <td>{{ optional($c->pegawai)->NIP ?? '-' }}</td>
                        <td style="font-weight:600;color:#fff;">{{ optional($c->pegawai)->nama_lengkap ?? '-' }}</td>
                        <td>{{ $c->jenis_cuti }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y') }}</td>
                        <td><span class="status-belum">{{ $durasi }} hari</span></td>
                        <td>
                            @if($c->status === 'disetujui')
                                <span class="status-active">Disetujui</span>
                            @elseif($c->status === 'pending')
                                <span class="status-cuti">Pending</span>
                            @else
                                <span class="status-nonaktif">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:2rem;color:#8b949e;">Belum ada data cuti untuk tahun {{ $tahun }}.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
    function filterCuti() {
        const t = document.getElementById('filterCutiTahun').value;
        window.location.href = '{{ route("laporan-cuti") }}?tahun=' + t;
    }
    function eksporCuti() {
        const t = document.getElementById('filterCutiTahun').value;
        window.location.href = '{{ route("laporan.exportCuti") }}?tahun=' + t;
    }
    </script>

@endsection
