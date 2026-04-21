@extends('layouts.layout-admin')

@section('title', 'Kelola Absensi')

@section('content')

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;">
        <div>
            <h4 style="color:#fff;font-weight:700;font-size:1.5rem;margin-bottom:0.25rem;">Kelola Absensi</h4>
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Monitoring dan verifikasi kehadiran pegawai</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Card Info --}}
    <div class="cards-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(34,197,94,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-check-circle" style="color:#4ade80;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Hadir</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;">{{ $hadir }}</h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(234,179,8,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-clock" style="color:#facc15;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Terlambat</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;">{{ $terlambat }}</h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(59,130,246,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-calendar-x" style="color:#60a5fa;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Cuti</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;">{{ $cuti }}</h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(239,68,68,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-x-circle" style="color:#f87171;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Alpa</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;">{{ $alpa }}</h3>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('absensi') }}" class="custom-card rounded-xl p-4" style="margin-bottom:1rem;">
        <div class="filter-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" class="modal-input w-full">
            </div>
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Cari Pegawai</label>
                <div style="display:flex;align-items:center;gap:0.5rem;" class="modal-input">
                    <i class="bi bi-search" style="color:#7a9a7a;"></i>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nama atau NIP..."
                        style="background:transparent;border:none;outline:none;color:#1a2e1a;font-size:0.875rem;width:100%;">
                </div>
            </div>
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Status</label>
                <select name="status" class="modal-input w-full" onchange="this.form.submit()">
                    <option value="semua" {{ $status == 'semua' || !$status ? 'selected' : '' }}>Semua Status</option>
                    <option value="hadir"             {{ $status == 'hadir'             ? 'selected' : '' }}>Hadir</option>
                    <option value="terlambat"         {{ $status == 'terlambat'         ? 'selected' : '' }}>Terlambat</option>
                    <option value="cuti"              {{ $status == 'cuti'              ? 'selected' : '' }}>Cuti</option>
                    <option value="tanpa keterangan"  {{ $status == 'tanpa keterangan'  ? 'selected' : '' }}>Alpa</option>
                </select>
            </div>
        </div>
        <button type="submit" style="margin-top:0.75rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;cursor:pointer;background:#1a6fdf;">
            <i class="bi bi-search me-1"></i> Cari
        </button>
    </form>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-absensi">
            <thead>
                <tr>
                    <th>TANGGAL</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JAM MASUK</th>
                    <th>JAM KELUAR</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $a)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal)->isoFormat('D MMM Y') }}</td>
                    <td>{{ $a->pegawai?->NIP ?? '-' }}</td>
                    <td style="font-weight:600;color:#fff;">{{ $a->pegawai?->nama_lengkap ?? '-' }}</td>
                    <td>{{ $a->jam_masuk ?? '--:--' }}</td>
                    <td>{{ $a->jam_keluar ?? '--:--' }}</td>
                    <td>
                        @php
                            $cls = [
                                'hadir'            => 'status-active',
                                'terlambat'        => 'status-cuti',
                                'cuti'             => 'status-cuti',
                                'tanpa keterangan' => 'status-inactive',
                            ][$a->status] ?? 'status-cuti';
                        @endphp
                        <span class="{{ $cls }}">{{ ucfirst($a->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:2.5rem 1rem;color:#7a9a7a;">Tidak ada data absensi untuk tanggal ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
