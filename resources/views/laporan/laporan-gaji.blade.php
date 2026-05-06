@extends('layouts.layout-admin')

@section('title', 'Laporan Gaji')

@section('content')

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;flex-wrap:wrap;gap:0.75rem;">
        <h2 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">Laporan Gaji</h2>
        <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
            <select id="filterGajiBulan" class="modal-input" style="width:130px;" onchange="filterGaji()">
                @foreach($bulanList as $b)
                    <option value="{{ $b }}" @if($b == $bulan) selected @endif>
                        {{ \Carbon\Carbon::create()->month($b)->format('F') }}
                    </option>
                @endforeach
            </select>
            <select id="filterGajiTahun" class="modal-input" style="width:85px;" onchange="filterGaji()">
                @foreach($tahunList as $t)
                    <option value="{{ $t }}" @if($t == $tahun) selected @endif>{{ $t }}</option>
                @endforeach
            </select>
            <button onclick="eksporGaji()"
                style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;background:#16a34a;cursor:pointer;white-space:nowrap;">
                <i class="bi bi-download"></i> Ekspor CSV
            </button>
        </div>
    </div>

    {{-- Cards --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;"><i class="bi bi-cash-coin" style="color:#facc15;margin-right:0.25rem;"></i> Total Penggajian</p>
            <h3 style="color:#fff;font-size:1.25rem;font-weight:700;margin:0.5rem 0 0;">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Sudah Dibayar</p>
            <h3 style="color:#22c55e;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $sudahDibayar }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Belum Dibayar</p>
            <h3 style="color:#f87171;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;">{{ $belumDibayar }}</h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Rata-Rata Gaji</p>
            <h3 style="color:#fff;font-size:1.25rem;font-weight:700;margin:0.5rem 0 0;">Rp {{ number_format($rataRata, 0, ',', '.') }}</h3>
        </div>
    </div>

    {{-- Search --}}
    <div class="search-wrapper" style="margin-top:1rem;">
        <i class="bi bi-search"></i>
        <input type="text" id="cari-laporan-gaji" placeholder="Cari nama atau jabatan...">
    </div>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="cari-laporan-gaji">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th>POTONGAN</th>
                    <th>TOTAL GAJI</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $g)
                    <tr>
                        <td>
                            <div style="font-weight:600;color:#fff;">{{ optional($g->pegawai)->nama_lengkap ?? '-' }}</div>
                            <div style="color:#8b949e;font-size:0.75rem;">{{ optional($g->pegawai)->NIP ?? '-' }}</div>
                        </td>
                        <td>{{ optional($g->pegawai->jabatan)->nama_jabatan ?? '-' }}</td>
                        <td>Rp {{ number_format($g->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($g->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($g->potongan, 0, ',', '.') }}</td>
                        <td style="font-weight:600;color:#fff;">Rp {{ number_format($g->total_gaji, 0, ',', '.') }}</td>
                        <td>
                            @if($g->status_bayar === 'Sudah Dibayar')
                                <span class="status-active">Sudah Dibayar</span>
                            @else
                                <span class="status-belum">Belum Dibayar</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:2rem;color:#8b949e;">Belum ada data gaji untuk periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
    function filterGaji() {
        const b = document.getElementById('filterGajiBulan').value;
        const t = document.getElementById('filterGajiTahun').value;
        window.location.href = '{{ route("laporan-gaji") }}?bulan=' + b + '&tahun=' + t;
    }
    function eksporGaji() {
        const b = document.getElementById('filterGajiBulan').value;
        const t = document.getElementById('filterGajiTahun').value;
        window.location.href = '{{ route("laporan.exportGaji") }}?bulan=' + b + '&tahun=' + t;
    }
    </script>

@endsection
