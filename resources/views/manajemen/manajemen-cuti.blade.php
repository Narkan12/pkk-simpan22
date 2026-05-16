@extends('layouts.layout-admin')

@section('title', 'Manajemen Cuti')

@section('content')

    {{-- Header --}}
    <div style="margin-top:2rem;margin-bottom:1rem;">
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
        <button type="submit" class="text-white" style="margin-top:0.75rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;cursor:pointer;background:#1a5c2e;">
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
                            onclick="openDetailCuti(
                                {{ $c->id }},
                                '{{ addslashes($c->pegawai?->nama_lengkap) }}',
                                '{{ $c->pegawai?->NIP }}',
                                '{{ addslashes($c->pegawai?->jabatan?->nama_jabatan ?? '-') }}',
                                '{{ addslashes($c->pegawai?->departemen?->nama_departemen ?? '-') }}',
                                '{{ $c->jenis_cuti }}',
                                '{{ $mulai->isoFormat('D MMMM Y') }}',
                                '{{ $selesai->isoFormat('D MMMM Y') }}',
                                {{ $durasi }},
                                '{{ addslashes($c->alasan ?? '-') }}',
                                '{{ $c->status }}',
                                '{{ addslashes($c->catatan_keputusan ?? '') }}',
                                '{{ addslashes($c->diputuskan_oleh ?? '') }}',
                                '{{ $c->diputuskan_pada ? $c->diputuskan_pada->isoFormat('D MMMM Y, HH:mm') : '' }}'
                            )">
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
                        @else
                        {{-- Tombol cetak surat hanya muncul jika sudah disetujui atau ditolak --}}
                        <a href="{{ route('manajemen-cuti.cetak', $c->id) }}" target="_blank"
                            class="btn-view" title="Cetak Surat Cuti">
                            <i class="bi bi-printer"></i>
                        </a>
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
    {{-- wrapper modal: posisi fixed, tengah layar, bisa scroll jika layar kecil --}}
    <div id="modalViewCuti" class="hidden" style="position:fixed;inset:0;z-index:200;align-items:center;justify-content:center;padding:1rem;background:rgba(20,83,45,0.35);overflow-y:auto;">
        <div class="modal-dark" style="max-width:520px;width:100%;">
            <div class="modal-header">
                <p class="modal-title">Detail Pengajuan Cuti</p>
                <button onclick="closeModal('modalViewCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            {{-- konten modal bisa di-scroll jika isinya panjang --}}
            <div class="modal-body" style="display:flex;flex-direction:column;gap:1rem;overflow-y:auto;">

                {{-- Hierarki: info pegawai --}}
                <div>
                    <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#388bfd;letter-spacing:0.07em;text-transform:uppercase;">
                        <i class="bi bi-person me-1"></i> Data Pegawai
                    </p>
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Nama</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-nama">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">NIP</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-nip">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Jabatan</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-jabatan">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Departemen</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-dept">-</p></div>
                    </div>
                </div>

                <div style="border-top:1px solid #e2ece2;"></div>

                {{-- Detail cuti --}}
                <div>
                    <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;color:#eab308;letter-spacing:0.07em;text-transform:uppercase;">
                        <i class="bi bi-calendar-check me-1"></i> Detail Cuti
                    </p>
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.5rem 1rem;">
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Jenis Cuti</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-jenis">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Durasi</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-durasi">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Tanggal Mulai</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-mulai">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Tanggal Selesai</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-selesai">-</p></div>
                        <div><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Status</p><p style="margin:0;" id="d-status">-</p></div>
                        <div style="grid-column:span 2;"><p style="color:#7a9a7a;font-size:0.75rem;margin:0;">Alasan Pengajuan</p><p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;" id="d-alasan">-</p></div>
                    </div>
                </div>

                {{-- Hierarki keputusan — hanya tampil jika sudah ada keputusan --}}
                <div id="d-blok-keputusan" style="display:none;border-top:1px solid #e2ece2;padding-top:1rem;">
                    <p style="font-size:0.75rem;font-weight:600;margin-bottom:0.5rem;letter-spacing:0.07em;text-transform:uppercase;" id="d-keputusan-label">
                        <i class="bi bi-shield-check me-1"></i> Keputusan Pimpinan
                    </p>
                    {{-- Garis hierarki visual --}}
                    <div style="display:flex;align-items:flex-start;gap:0.75rem;">
                        <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                            <div style="width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;" id="d-hierarki-icon">
                                <i class="bi bi-person-badge-fill" style="font-size:1rem;color:#fff;"></i>
                            </div>
                            <div style="width:2px;height:24px;background:#e2ece2;margin-top:4px;"></div>
                            <div style="width:8px;height:8px;border-radius:50%;background:#e2ece2;"></div>
                        </div>
                        <div style="flex:1;padding-top:4px;">
                            <p style="color:#7a9a7a;font-size:0.7rem;margin:0;">Diputuskan oleh</p>
                            <p style="color:#1a2e1a;font-size:0.875rem;font-weight:700;margin:0 0 4px;" id="d-diputuskan-oleh">-</p>
                            <p style="color:#7a9a7a;font-size:0.7rem;margin:0;">Pada</p>
                            <p style="color:#1a2e1a;font-size:0.8rem;font-weight:600;margin:0 0 8px;" id="d-diputuskan-pada">-</p>
                            <p style="color:#7a9a7a;font-size:0.7rem;margin:0 0 2px;">Catatan / Alasan Keputusan</p>
                            <p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;font-style:italic;" id="d-catatan">-</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button onclick="closeModal('modalViewCuti')" class="modal-btn-cancel">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Setujui/Tolak — dengan textarea alasan keputusan --}}
    <div id="modalKonfirmasi" class="hidden" style="position:fixed;inset:0;z-index:200;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <div class="modal-dark" style="max-width:400px;">
            <div class="modal-header">
                <p class="modal-title" id="k-title">Konfirmasi</p>
                <button onclick="closeModal('modalKonfirmasi')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:flex;flex-direction:column;gap:0.875rem;padding:1.25rem 1rem;">

                {{-- Ikon + info pengajuan --}}
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;flex-shrink:0;" id="k-icon-wrap">
                        <i style="font-size:1.25rem;" id="k-icon"></i>
                    </div>
                    <div>
                        <p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin-bottom:0.25rem;" id="k-question">-</p>
                        <p style="color:#7a9a7a;font-size:0.75rem;margin:0;" id="k-desc">-</p>
                    </div>
                </div>

                {{-- Hierarki: siapa yang memutuskan --}}
                <div style="border-radius:0.5rem;padding:0.625rem 0.75rem;background:#f0fdf4;border:1px solid #bbf7d0;">
                    <p style="color:#7a9a7a;font-size:0.7rem;margin:0 0 2px;">Keputusan dibuat oleh</p>
                    <p style="color:#1a2e1a;font-size:0.875rem;font-weight:700;margin:0;">
                        <i class="bi bi-person-badge-fill me-1" style="color:#1a5c2e;"></i>
                        {{ Auth::user()->username }} <span style="font-weight:400;color:#7a9a7a;">({{ ucfirst(Auth::user()->role) }})</span>
                    </p>
                </div>

                {{-- Textarea alasan keputusan --}}
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;" id="k-label-catatan">
                        Catatan / Alasan Keputusan <span style="color:#7a9a7a;">(opsional)</span>
                    </label>
                    <textarea id="k-catatan" name="catatan_keputusan" rows="3"
                        placeholder="Contoh: Disetujui karena pegawai memiliki sisa cuti yang cukup..."
                        class="modal-input" style="resize:none;width:100%;"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button onclick="closeModal('modalKonfirmasi')" class="modal-btn-cancel">Batal</button>
                <form id="k-form" method="POST" style="flex:1;">
                    @csrf @method('PATCH')
                    {{-- Input hidden untuk catatan — nilainya diisi JS sebelum submit --}}
                    <input type="hidden" name="catatan_keputusan" id="k-catatan-hidden">
                    <button type="submit" id="k-btn"
                        style="width:100%;padding:0.5rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;">
                        Ya, Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    const manajemenCutiBaseUrl = "{{ url('manajemen-cuti') }}";

    // Buka modal detail cuti — sekarang menerima data keputusan juga
    function openDetailCuti(id, nama, nip, jabatan, dept, jenis, mulai, selesai, durasi, alasan, status, catatan, diputuskanOleh, diputuskanPada) {
        document.getElementById('d-nama').textContent    = nama;
        document.getElementById('d-nip').textContent     = nip;
        document.getElementById('d-jabatan').textContent = jabatan;
        document.getElementById('d-dept').textContent    = dept;
        document.getElementById('d-jenis').textContent   = jenis;
        document.getElementById('d-durasi').textContent  = durasi + ' hari';
        document.getElementById('d-mulai').textContent   = mulai;
        document.getElementById('d-selesai').textContent = selesai;
        document.getElementById('d-alasan').textContent  = alasan || '-';

        const statusMap = { pending: 'Pending', disetujui: 'Disetujui', ditolak: 'Ditolak' };
        const statusClass = { pending: 'status-cuti', disetujui: 'status-active', ditolak: 'status-nonaktif' };
        document.getElementById('d-status').innerHTML = `<span class="${statusClass[status] ?? 'status-cuti'}">${statusMap[status] ?? status}</span>`;

        // Tampilkan blok keputusan hierarki jika sudah ada keputusan
        const blokKeputusan = document.getElementById('d-blok-keputusan');
        if (status !== 'pending' && diputuskanOleh) {
            blokKeputusan.style.display = 'block';

            const isSetujui = status === 'disetujui';
            const warna = isSetujui ? '#1a5c2e' : '#c62828';
            const warnaLight = isSetujui ? '#e8f5e9' : '#fdecea';
            const labelTeks = isSetujui ? '✔ Disetujui oleh Pimpinan' : '✘ Ditolak oleh Pimpinan';

            document.getElementById('d-keputusan-label').style.color = warna;
            document.getElementById('d-keputusan-label').innerHTML = `<i class="bi bi-shield-check me-1"></i> ${labelTeks}`;
            document.getElementById('d-hierarki-icon').style.background = warna;
            document.getElementById('d-diputuskan-oleh').textContent = diputuskanOleh;
            document.getElementById('d-diputuskan-pada').textContent  = diputuskanPada || '-';
            document.getElementById('d-catatan').textContent = catatan || '(tidak ada catatan)';
            document.getElementById('d-catatan').style.color = catatan ? '#1a2e1a' : '#7a9a7a';
        } else {
            blokKeputusan.style.display = 'none';
        }

        openModal('modalViewCuti');
    }

    // Buka modal konfirmasi setujui/tolak
    function openKonfirmasi(tipe, id, nama, jenis, durasi) {
        const isSetujui = tipe === 'setujui';

        document.getElementById('k-title').textContent    = isSetujui ? 'Setujui Pengajuan Cuti' : 'Tolak Pengajuan Cuti';
        document.getElementById('k-question').textContent = isSetujui ? 'Yakin ingin menyetujui cuti ini?' : 'Yakin ingin menolak cuti ini?';
        document.getElementById('k-desc').textContent     = `${nama} — ${jenis} — ${durasi} hari`;
        document.getElementById('k-label-catatan').innerHTML = isSetujui
            ? 'Catatan persetujuan <span style="color:#7a9a7a;">(opsional)</span>'
            : 'Alasan penolakan <span style="color:#e05c5c;">*</span>';
        document.getElementById('k-catatan').placeholder = isSetujui
            ? 'Contoh: Disetujui karena pegawai memiliki sisa cuti yang cukup...'
            : 'Contoh: Ditolak karena kebutuhan operasional departemen...';

        document.getElementById('k-icon').className       = isSetujui ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill';
        document.getElementById('k-icon').style.color     = isSetujui ? '#3fb950' : '#f85149';
        document.getElementById('k-icon-wrap').style.background = isSetujui ? 'rgba(35,134,54,0.15)' : 'rgba(163,45,45,0.15)';
        document.getElementById('k-icon-wrap').style.border     = isSetujui ? '1px solid rgba(35,134,54,0.4)' : '1px solid rgba(163,45,45,0.4)';
        document.getElementById('k-btn').style.background = isSetujui ? '#238636' : '#a32d2d';
        document.getElementById('k-catatan').value = '';

        document.getElementById('k-form').action = isSetujui
            ? `${manajemenCutiBaseUrl}/${id}/setujui`
            : `${manajemenCutiBaseUrl}/${id}/tolak`;

        openModal('modalKonfirmasi');
    }

    // Salin nilai textarea ke input hidden sebelum form disubmit
    document.getElementById('k-form').addEventListener('submit', function () {
        document.getElementById('k-catatan-hidden').value = document.getElementById('k-catatan').value;
    });
    </script>

@endsection
