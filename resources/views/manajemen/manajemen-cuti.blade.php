@extends('layouts.layout-admin')

@section('title', 'Manajemen Cuti')

@section('content')

    {{-- Header --}}
    <div style="margin-top:1rem;margin-bottom:1rem;">
        <h4 style="color:#fff;font-weight:700;font-size:1.5rem;margin-bottom:0.25rem;">Manajemen Cuti</h4>
        <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Kelola dan approve pengajuan cuti pegawai</p>
    </div>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Card Info --}}
    <div class="cards-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem;">
        <div style="border-radius:0.75rem;padding:1.25rem;border:1px solid rgba(234,179,8,0.3);background:rgba(161,120,3,0.15);">
            <p style="color:#eab308;font-size:0.875rem;font-weight:600;margin:0;">Menunggu Approval</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.75rem 0 0;">{{ $pending }}</h3>
        </div>
        <div style="border-radius:0.75rem;padding:1.25rem;border:1px solid rgba(3,201,80,0.3);background:rgba(3,201,80,0.1);">
            <p style="color:#03C950;font-size:0.875rem;font-weight:600;margin:0;">Disetujui</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.75rem 0 0;">{{ $disetujui }}</h3>
        </div>
        <div style="border-radius:0.75rem;padding:1.25rem;border:1px solid rgba(224,92,92,0.3);background:rgba(224,92,92,0.1);">
            <p style="color:#e05c5c;font-size:0.875rem;font-weight:600;margin:0;">Ditolak</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.75rem 0 0;">{{ $ditolak }}</h3>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('manajemen-cuti') }}" class="custom-card rounded-xl p-4" style="margin-bottom:1rem;">
        <div class="filter-grid-2" style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;">
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Cari Pegawai</label>
                <div style="display:flex;align-items:center;gap:0.5rem;" class="modal-input">
                    <i class="bi bi-search" style="color:#7a9a7a;"></i>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nama atau NIP..."
                        style="background:transparent;border:none;outline:none;color:#1a2e1a;font-size:0.875rem;width:100%;">
                </div>
            </div>
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Filter Status</label>
                <select name="status" class="modal-input w-full" onchange="this.form.submit()">
                    <option value="semua"     {{ $status == 'semua' || !$status ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending"   {{ $status == 'pending'   ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak"   {{ $status == 'ditolak'   ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </div>
        <button type="submit" style="margin-top:0.75rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;cursor:pointer;background:#1a6fdf;">
            <i class="bi bi-search me-1"></i> Cari
        </button>
    </form>

    {{-- Tabel --}}
    <div class="table-dark-custom">
        <table class="w-full datatable">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>DEPARTEMEN</th>
                    <th>JENIS CUTI</th>
                    <th>PERIODE</th>
                    <th>DURASI</th>
                    <th>STATUS</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cutiList as $c)
                @php
                    $mulai   = \Carbon\Carbon::parse($c->tanggal_mulai);
                    $selesai = \Carbon\Carbon::parse($c->tanggal_selesai);
                    $durasi  = $mulai->diffInDays($selesai) + 1;
                @endphp
                <tr>
                    <td>
                        <div style="font-weight:600;color:#1a2e1a;">{{ $c->pegawai?->nama_lengkap ?? '-' }}</div>
                        <div style="color:#7a9a7a;font-size:0.75rem;margin-top:2px;">{{ $c->pegawai?->NIP ?? '-' }}</div>
                    </td>
                    <td>{{ $c->pegawai?->departemen?->nama_departemen ?? '-' }}</td>
                    <td>{{ $c->jenis_cuti }}</td>
                    <td>
                        <i class="bi bi-calendar3 me-1" style="color:#7a9a7a;"></i>
                        {{ $mulai->isoFormat('D MMM') }} – {{ $selesai->isoFormat('D MMM Y') }}
                    </td>
                    <td><span class="status-cuti">{{ $durasi }} hari</span></td>
                    <td>
                        @if($c->status === 'pending')
                            <span class="status-cuti">Pending</span>
                        @elseif($c->status === 'disetujui')
                            <span class="status-active">Disetujui</span>
                        @else
                            <span class="status-nonaktif">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn-view" title="Lihat Detail"
                            onclick="openDetailCuti({{ $c->id }}, '{{ addslashes($c->pegawai?->nama_lengkap) }}', '{{ $c->pegawai?->NIP }}', '{{ addslashes($c->pegawai?->jabatan?->nama_jabatan ?? '-') }}', '{{ addslashes($c->pegawai?->departemen?->nama_departemen ?? '-') }}', '{{ $c->jenis_cuti }}', '{{ $mulai->isoFormat('D MMMM Y') }}', '{{ $selesai->isoFormat('D MMMM Y') }}', {{ $durasi }}, '{{ addslashes($c->alasan ?? '-') }}', '{{ $c->status }}')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                        @if($c->status === 'pending')
                        <button class="btn-view" title="Setujui"
                            onclick="openKonfirmasi('setujui', {{ $c->id }}, '{{ addslashes($c->pegawai?->nama_lengkap) }}', '{{ $c->jenis_cuti }}', {{ $durasi }})">
                            <i class="bi bi-check-circle-fill"></i>
                        </button>
                        <button class="btn-delete" title="Tolak"
                            onclick="openKonfirmasi('tolak', {{ $c->id }}, '{{ addslashes($c->pegawai?->nama_lengkap) }}', '{{ $c->jenis_cuti }}', {{ $durasi }})">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:2.5rem 1rem;color:#7a9a7a;">Belum ada pengajuan cuti.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Detail --}}
    <div id="modalViewCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <div class="modal-dark" style="max-width:480px;">
            <div class="modal-header">
                <p class="modal-title">Detail Pengajuan Cuti</p>
                <button onclick="closeModal('modalViewCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:flex;flex-direction:column;gap:1rem;">
                <div>
                    <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#388bfd;letter-spacing:0.07em;text-transform:uppercase;"><i class="bi bi-person me-1"></i> Data Pegawai</p>
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Nama</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-nama">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">NIP</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-nip">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Departemen</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-dept">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Jabatan</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-jabatan">-</p></div>
                    </div>
                </div>
                <div style="border-top:1px solid #e2ece2;"></div>
                <div>
                    <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#eab308;letter-spacing:0.07em;text-transform:uppercase;"><i class="bi bi-calendar-check me-1"></i> Detail Cuti</p>
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Jenis Cuti</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-jenis">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Durasi</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-durasi">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Tanggal Mulai</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-mulai">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Tanggal Selesai</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-selesai">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Status</p><p style="margin:0;" id="d-status">-</p></div>
                        <div style="grid-column:span 2;"><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Alasan</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-alasan">-</p></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal('modalViewCuti')" class="modal-btn-cancel">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Setujui/Tolak --}}
    <div id="modalKonfirmasi" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <div class="modal-dark" style="max-width:360px;">
            <div class="modal-header">
                <p class="modal-title" id="k-title">Konfirmasi</p>
                <button onclick="closeModal('modalKonfirmasi')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:0.75rem;padding:1.25rem 1rem;">
                <div style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;" id="k-icon-wrap">
                    <i style="font-size:1.25rem;" id="k-icon"></i>
                </div>
                <div>
                    <p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin-bottom:0.25rem;" id="k-question">-</p>
                    <p style="color:#7a9a7a;font-size:0.75rem;margin:0;" id="k-desc">-</p>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal('modalKonfirmasi')" class="modal-btn-cancel">Batal</button>
                <form id="k-form" method="POST" style="flex:1;">
                    @csrf @method('PATCH')
                    <button type="submit" id="k-btn" style="width:100%;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;">Ya, Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    const manajemenCutiBaseUrl = "{{ url('manajemen-cuti') }}";

    function openDetailCuti(id, nama, nip, jabatan, dept, jenis, mulai, selesai, durasi, alasan, status) {
        document.getElementById('d-nama').textContent    = nama;
        document.getElementById('d-nip').textContent     = nip;
        document.getElementById('d-jabatan').textContent = jabatan;
        document.getElementById('d-dept').textContent    = dept;
        document.getElementById('d-jenis').textContent   = jenis;
        document.getElementById('d-durasi').textContent  = durasi + ' hari';
        document.getElementById('d-mulai').textContent   = mulai;
        document.getElementById('d-selesai').textContent = selesai;
        document.getElementById('d-alasan').textContent  = alasan;
        const statusMap = { pending: 'Pending', disetujui: 'Disetujui', ditolak: 'Ditolak' };
        document.getElementById('d-status').innerHTML = `<span class="status-cuti">${statusMap[status] ?? status}</span>`;
        openModal('modalViewCuti');
    }

    function openKonfirmasi(tipe, id, nama, jenis, durasi) {
        const isSetujui = tipe === 'setujui';
        document.getElementById('k-title').textContent    = isSetujui ? 'Setujui Pengajuan Cuti' : 'Tolak Pengajuan Cuti';
        document.getElementById('k-question').textContent = isSetujui ? 'Yakin ingin menyetujui cuti ini?' : 'Yakin ingin menolak cuti ini?';
        document.getElementById('k-desc').textContent     = `${nama} — ${jenis} — ${durasi} hari`;
        document.getElementById('k-icon').className       = isSetujui ? 'bi bi-check-circle-fill text-xl' : 'bi bi-x-circle-fill text-xl';
        document.getElementById('k-icon').style.color     = isSetujui ? '#3fb950' : '#f85149';
        document.getElementById('k-icon-wrap').style.background = isSetujui ? 'rgba(35,134,54,0.15)' : 'rgba(163,45,45,0.15)';
        document.getElementById('k-icon-wrap').style.border     = isSetujui ? '1px solid rgba(35,134,54,0.4)' : '1px solid rgba(163,45,45,0.4)';
        document.getElementById('k-btn').style.background = isSetujui ? '#238636' : '#a32d2d';
        document.getElementById('k-form').action = isSetujui
            ? `${manajemenCutiBaseUrl}/${id}/setujui`
            : `${manajemenCutiBaseUrl}/${id}/tolak`;
        openModal('modalKonfirmasi');
    }
    </script>

@endsection
