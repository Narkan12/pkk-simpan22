@extends('layouts.layout-pegawai')

@section('title', 'SIMPAN - Dashboard Pegawai')

@section('content')

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Header --}}
    <div style="margin-bottom:1.25rem;">
        <h4 style="color:#1a2e1a;font-weight:700;font-size:1.25rem;margin-bottom:2px;">
            {{ $pegawai->nama_lengkap ?? auth()->user()->name }}
        </h4>
        <p style="color:#7a9a7a;font-size:0.75rem;">
            {{ $pegawai->jabatan?->nama_jabatan ?? 'Pegawai' }} &mdash; {{ now()->isoFormat('D MMMM Y') }}
        </p>
    </div>

    {{-- Ringkasan --}}
    <div class="summary-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:0.75rem;margin-bottom:1.25rem;">
        <div class="summary-card">
            <p class="summary-card-label">Hadir Bulan Ini</p>
            <p class="summary-card-value">{{ $hariKerja }} / {{ $totalHariKerja }}</p>
        </div>
        <div class="summary-card">
            <p class="summary-card-label">Sisa Cuti</p>
            <p class="summary-card-value">{{ $pegawai->jatah_cuti ?? 0 }} hari</p>
        </div>
        <div class="summary-card">
            <p class="summary-card-label">Status Kerja</p>
            <p class="summary-card-value">{{ ucfirst($pegawai->status->nama_status ?? '-') }}</p>
        </div>
    </div>

    {{-- Aksi --}}
    <div class="action-grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;margin-bottom:1.25rem;">
        <button onclick="openModal('modalAbsensi')" class="action-card action-card-green">
            <i class="bi bi-calendar-check action-card-icon" style="color:#03C950;"></i>
            <span class="action-card-label">Absensi</span>
        </button>
        <button onclick="openModal('modalCuti')" class="action-card action-card-yellow">
            <i class="bi bi-file-earmark-text action-card-icon" style="color:#eab308;"></i>
            <span class="action-card-label">Ajukan Cuti</span>
        </button>
    </div>

    {{-- Tabel Absensi Terbaru --}}
    <div style="border-radius:0.5rem;overflow:hidden;border:1px solid #e2ece2;">
        <div style="padding:0.75rem 1rem;border-bottom:1px solid #e2ece2;background:#ffffff;">
            <p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;">Absensi Terbaru</p>
        </div>
        <table style="width:100%;font-size:0.875rem;background:#ffffff;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #e2ece2;">
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">TANGGAL</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">MASUK</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">KELUAR</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensiTerbaru as $absensi)
                <tr style="border-bottom:1px solid #e2ece2;">
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;">{{ \Carbon\Carbon::parse($absensi->tanggal)->isoFormat('D MMM') }}</td>
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;">{{ $absensi->jam_masuk ?? '--:--' }}</td>
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;">{{ $absensi->jam_keluar ?? '--:--' }}</td>
                    <td style="padding:0.625rem 1rem;">
                        @php
                            $statusClass = [
                                'hadir'            => 'badge-hadir',
                                'terlambat'        => 'badge-terlambat',
                                'cuti'             => 'badge-cuti',
                                'tanpa keterangan' => 'badge-alpa',
                            ][$absensi->status] ?? 'badge-default';
                        @endphp
                        <span class="{{ $statusClass }}">{{ ucfirst($absensi->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:2.5rem 1rem;text-align:center;color:#7a9a7a;">Belum ada riwayat absensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Notifikasi Cuti --}}
    @if($riwayatCuti->isNotEmpty())
    @php
        $c = $riwayatCuti->first();
        $durasi = \Carbon\Carbon::parse($c->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($c->tanggal_selesai)) + 1;
        $warna  = match($c->status) {
            'disetujui' => ['bg'=>'#f0fdf4','border'=>'#bbf7d0','dot'=>'#16a34a','text'=>'#15803d','label'=>'Disetujui'],
            'ditolak'   => ['bg'=>'#fef2f2','border'=>'#fecaca','dot'=>'#dc2626','text'=>'#b91c1c','label'=>'Ditolak'],
            default     => ['bg'=>'#fefce8','border'=>'#fde68a','dot'=>'#ca8a04','text'=>'#92400e','label'=>'Menunggu'],
        };
    @endphp
    <div style="margin-top:1rem;border-radius:0.5rem;overflow:hidden;border:1px solid {{ $warna['border'] }};background:{{ $warna['bg'] }};padding:0.75rem 1rem;display:flex;align-items:center;gap:0.75rem;">
        <span style="width:8px;height:8px;border-radius:50%;background:{{ $warna['dot'] }};flex-shrink:0;display:inline-block;"></span>
        <div style="flex:1;min-width:0;">
            <span style="font-size:0.8125rem;color:#1a2e1a;font-weight:600;">
                <i class="bi bi-bell" style="margin-right:0.25rem;color:{{ $warna['dot'] }};"></i>{{ $c->jenis_cuti }}
            </span>
            <span style="font-size:0.75rem;color:#7a9a7a;margin-left:0.5rem;">
                {{ \Carbon\Carbon::parse($c->tanggal_mulai)->format('d M') }} – {{ \Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y') }}
                ({{ $durasi }} hari)
            </span>
        </div>
        <span style="font-size:0.75rem;font-weight:600;color:{{ $warna['text'] }};background:{{ $warna['border'] }};padding:2px 10px;border-radius:999px;flex-shrink:0;">
            {{ $warna['label'] }}
        </span>
    </div>
    @endif

    {{-- MODAL ABSENSI --}}
    <div id="modalAbsensi" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <form action="{{ route('absensi.simpan') }}" method="POST" class="modal-dark" style="max-width:360px;">
            @csrf
            <div class="modal-header">
                <p class="modal-title">Catat Absensi</p>
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:flex;flex-direction:column;gap:0.75rem;">
                <div style="border-radius:0.5rem;padding:0.75rem;text-align:center;border:1px solid rgba(3,201,80,0.2);background:rgba(3,201,80,0.06);">
                    <p style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                    <p style="color:#1a2e1a;font-weight:700;font-size:1.25rem;margin:0;" id="jamPegawai">--:--:--</p>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis</label>
                    <select name="jenis" class="modal-input">
                        <option value="masuk">Check-in (Masuk)</option>
                        <option value="keluar">Check-out (Keluar)</option>
                    </select>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Opsional" class="modal-input">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-btn-cancel">Batal</button>
                <button type="submit" class="modal-btn-submit">Simpan</button>
            </div>
        </form>
    </div>

    {{-- MODAL CUTI --}}
    <div id="modalCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <form action="{{ route('cuti.ajukan') }}" method="POST" class="modal-dark" style="max-width:400px;">
            @csrf
            <div class="modal-header">
                <p class="modal-title">Ajukan Cuti</p>
                <button type="button" onclick="closeModal('modalCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;">
                <div style="grid-column:span 2;">
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Cuti <span style="color:#e05c5c;">*</span></label>
                    <select name="jenis_cuti" required class="modal-input">
                        <option value="">Pilih</option>
                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                        <option value="Cuti Sakit">Cuti Sakit</option>
                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                        <option value="Izin Penting">Izin Penting</option>
                    </select>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Mulai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_mulai" required class="modal-input">
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Selesai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_selesai" required class="modal-input">
                </div>
                <div style="grid-column:span 2;">
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alasan</label>
                    <textarea name="alasan" rows="2" placeholder="Alasan cuti" class="modal-input" style="resize:none;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalCuti')" class="modal-btn-cancel">Batal</button>
                <button type="submit" class="modal-btn-primary">Kirim</button>
            </div>
        </form>
    </div>


    @endsection
