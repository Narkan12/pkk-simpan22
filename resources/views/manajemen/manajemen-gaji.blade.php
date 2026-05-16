@extends('layouts.layout-admin')

@section('title', 'Manajemen Gaji')

@section('content')

    {{-- Header --}}
    <div style="margin-top:1rem;margin-bottom:1rem;">
        <h4 style="color:#fff;font-weight:700;font-size:1.5rem;margin-bottom:0.25rem;">Manajemen Gaji</h4>
        <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Kelola data gaji pegawai</p>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    {{-- Card Info Statistik --}}
    <div class="cards-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem;">
        <!-- Total Pegawai -->
        <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:0.75rem; padding:1.25rem;">
            <p style="color:#2563eb; font-size:0.8rem; font-weight:600; margin:0;">Total Pegawai</p>
            <p style="color:#1e40af; font-size:1.75rem; font-weight:700; margin:0.25rem 0 0;">{{ $totalPegawai }}</p>
        </div>

        <!-- Sudah Dibayar -->
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:0.75rem; padding:1.25rem;">
            <p style="color:#16a34a; font-size:0.8rem; font-weight:600; margin:0;">Sudah Dibayar</p>
            <p style="color:#15803d; font-size:1.75rem; font-weight:700; margin:0.25rem 0 0;">{{ $sudahDibayar }}</p>
        </div>

        <!-- Belum Dibayar -->
        <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:0.75rem; padding:1.25rem;">
            <p style="color:#dc2626; font-size:0.8rem; font-weight:600; margin:0;">Belum Dibayar</p>
            <p style="color:#b91c1c; font-size:1.75rem; font-weight:700; margin:0.25rem 0 0;">{{ $belumDibayar }}</p>
        </div>
    </div>

    {{-- Filter & Generate --}}
    <div class="custom-card rounded-xl p-4" style="margin-bottom:1rem;">
        <div style="display:flex;gap:1rem;margin-bottom:0;flex-wrap:wrap;align-items:flex-end;">
            <div style="flex:1;min-width:150px;">
                <label class="custom-paragraph"
                    style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Bulan</label>
                <select id="filterBulan" class="modal-input" onchange="filterGaji()">
                    @foreach ($bulanList as $b)
                        <option value="{{ $b }}" @if ($b == $bulan) selected @endif>
                            {{ \Carbon\Carbon::create()->month($b)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex:1;min-width:150px;">
                <label class="custom-paragraph"
                    style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Tahun</label>
                <select id="filterTahun" class="modal-input" onchange="filterGaji()">
                    @foreach ($tahunList as $t)
                        <option value="{{ $t }}" @if ($t == $tahun) selected @endif>
                            {{ $t }}</option>
                    @endforeach
                </select>
            </div>
            @can('generate-gaji')
            <div>
                <button type="button" onclick="generateGaji()" class="btn-tambah-data"
                    style="padding:0.5rem 1rem;background:#16a34a;border:none;border-radius:0.5rem;font-weight:600;cursor:pointer;" class="text-white">
                    <i class="bi bi-plus me-1"></i>Generate Gaji
                </button>
            </div>
            @endcan
        </div>
    </div>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th>POTONGAN</th>
                    <th>TOTAL GAJI</th>
                    <th>STATUS</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gaji as $g)
                    <tr>
                        <td>
                            <div style="font-weight:600;color:#fff;">{{ $g->pegawai->nama_lengkap }}</div>
                            <div style="color:#8b949e;font-size:0.75rem;margin-top:2px;">{{ $g->pegawai->NIP ?? '-' }}
                            </div>
                        </td>
                        <td>{{ $g->pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                        <td>Rp {{ number_format($g->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($g->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($g->potongan, 0, ',', '.') }}</td>
                        <td style="color:#fff;font-weight:600;">Rp {{ number_format($g->total_gaji, 0, ',', '.') }}</td>
                        <td>
                            @if ($g->status_bayar === 'Sudah Dibayar')
                                <span class="status-active">Sudah Dibayar</span>
                            @else
                                <span class="status-cuti">Belum Dibayar</span>
                            @endif
                        </td>
                        <td>
                            @can('edit-gaji')
                            @if ($g->status_bayar === 'Belum Dibayar')
                                <form action="{{ route('gaji.update', $g->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status_bayar" value="Sudah Dibayar">
                                    <button type="submit" class="btn-view" title="Tandai Dibayar">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>
                            @endif
                            @endcan
                            @can('delete-gaji')
                            <form action="{{ route('gaji.destroy', $g->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="padding:2rem;text-align:center;color:#8b949e;">
                            Belum ada data gaji. <br>
                            <small>Gunakan tombol "Generate Gaji" untuk membuat data gaji pegawai.</small>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Hidden Form untuk Generate Gaji -->
    <form id="generateForm" action="{{ route('gaji.store') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" id="generateBulan" name="bulan" value="">
        <input type="hidden" id="generateTahun" name="tahun" value="">
    </form>

    <script>
        function generateGaji() {
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;
            const bulanText = document.getElementById('filterBulan').options[document.getElementById('filterBulan')
                .selectedIndex].text;

            if (confirm('Generate gaji untuk ' + bulanText + ' ' + tahun + '?')) {
                document.getElementById('generateBulan').value = bulan;
                document.getElementById('generateTahun').value = tahun;
                document.getElementById('generateForm').submit();
            }
        }

        function filterGaji() {
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;
            window.location.href = '{{ route('manajemen-gaji') }}?bulan=' + bulan + '&tahun=' + tahun;
        }
    </script>

@endsection
