@extends('layouts.layout-admin')

@section('title', 'Daftar Pegawai')

@section('content')

    {{-- Header --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Daftar Pegawai</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahPegawai')">
            <i class="bi bi-plus"></i> Tambah Pegawai
        </button>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <ul style="margin:0;padding-left:1.25rem;">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="cards-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Total Pegawai</p>
            <h3 style="color:#fff;font-size:1.25rem;font-weight:700;margin:0;">{{ $totalPegawai }}</h3>
        </div>
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Pegawai Aktif</p>
            <h3 style="font-size:1.25rem;font-weight:700;margin:0;color:#3fb950;">{{ $pegawaiAktif }}</h3>
        </div>
        <div class="custom-card rounded-xl p-4" style="border:1px solid #1f2937;">
            <p class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;">Pegawai Nonaktif/ Lainnya</p>
            <h3 style="font-size:1.25rem;font-weight:700;margin:0;color:#eab308;">{{ ($pegawaiNonAktif ?? 0) + ($pegawaiLainnya ?? 0) }}</h3>
        </div>
    </div>

    {{-- Search --}}
    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-data-pegawai" placeholder="Cari NIP, Nama, atau Jabatan...">
    </div>

    {{-- Table --}}
    <div class="table-dark-custom" style="margin-top:1rem;">
        <table class="w-full datatable" data-search="search-data-pegawai">
            <thead>
                <tr>
                    <th style="width:50px;">FOTO</th>
                    <th>NIP</th>
                    <th>NAMA LENGKAP</th>
                    <th>JABATAN</th>
                    <th>DEPARTEMEN</th>
                    <th>GOLONGAN</th>
                    <th>STATUS</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $pegawai)
                    @php
                        $statusName = $pegawai->status->nama_status ?? '';
                        $warnaStatus = match (strtolower($statusName)) {
                            'aktif'              => 'status-active',
                            'cuti'               => 'status-cuti',
                            'non-aktif','nonaktif' => 'status-nonaktif',
                            'pensiun'            => 'status-pensiun',
                            'kontrak'            => 'status-kontrak',
                            default              => 'status-lainnya',
                        };
                    @endphp
                    <tr>
                        <td style="text-align:center; padding:0.75rem 1.25rem;">
                            @if($pegawai->foto)
                                <img src="{{ asset('storage/' . $pegawai->foto) }}"
                                    style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #16a34a;">
                            @else
                                <div style="width:36px; height:36px; border-radius:50%; background:#16a34a; display:inline-flex; align-items:center; justify-content:center; color:#fff; font-weight:600; font-size:0.75rem;">
                                    {{ strtoupper(substr($pegawai->nama_lengkap, 0, 2)) }}
                                </div>
                            @endif
                        </td>
                        <td class="text-xs font-semibold">{{ $pegawai->NIP }}</td>
                        <td class="font-semibold" style="color:#111827;">{{ $pegawai->nama_lengkap }}</td>
                        <td>{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                        <td> <span class="status-departemen">{{ $pegawai->departemen->nama_departemen ?? '-' }}</span></td>
                        <td> {{ $pegawai->golongan->nama_golongan ?? '-' }}</td>
                        <td><span class="{{ $warnaStatus }}">{{ ucfirst($statusName ?: '-') }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;">

                                {{-- View --}}
                                <button type="button" class="btn-view" title="Lihat Detail"
                                    onclick="showDetailPegawai({
                                        viewNIK:              '{{ $pegawai->NIK ?? '-' }}',
                                        viewNIP:              '{{ $pegawai->NIP ?? '-' }}',
                                        viewNama:             '{{ addslashes($pegawai->nama_lengkap ?? '-') }}',
                                        viewJenisKelamin:     '{{ ($pegawai->jenis_kelamin ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' }}',
                                        viewAgama:            '{{ $pegawai->agama ?? '-' }}',
                                        viewTempatLahir:      '{{ $pegawai->tempat_lahir ?? '-' }}',
                                        viewTanggalLahir:     '{{ $pegawai->tanggal_lahir ?? '-' }}',
                                        viewStatusPernikahan: '{{ $pegawai->status_pernikahan ?? '-' }}',
                                        viewNoTelepon:        '{{ $pegawai->no_telp ?? '-' }}',
                                        viewAlamat:           '{{ addslashes($pegawai->alamat ?? '-') }}',
                                        viewJabatan:          '{{ $pegawai->jabatan->nama_jabatan ?? '-' }}',
                                        viewDepartemen:       '{{ $pegawai->departemen->nama_departemen ?? '-' }}',
                                        viewGolongan:         '{{ $pegawai->golongan->nama_golongan ?? '-' }}',
                                        viewPendidikan:       '{{ $pegawai->pendidikan->jenjang ?? '-' }}',
                                        viewTglMasuk:         '{{ $pegawai->tanggal_masuk ?? '-' }}',
                                        viewJenisPegawai:     '{{ $pegawai->jenis_pegawai ?? '-' }}',
                                        viewStatus:           '{{ ucfirst($statusName) }}',
                                        viewStatusClass:      '{{ $warnaStatus }}',
                                        viewFoto:             '{{ $pegawai->foto ?? '' }}',

                                    })">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                {{-- Edit --}}
                                <button type="button" class="btn-view" title="Edit"
                                    onclick="openModalEditGeneric('formEditPegawai', 'modalEditPegawai', {
                                        action:           '{{ route('dataPegawai.update', $pegawai->id) }}',
                                        editNik:          '{{ $pegawai->NIK }}',
                                        editNip:          '{{ $pegawai->NIP }}',
                                        editNama:         '{{ addslashes($pegawai->nama_lengkap) }}',
                                        editJk:           '{{ $pegawai->jenis_kelamin }}',
                                        editAgama:        '{{ $pegawai->agama }}',
                                        editTempatLahir:  '{{ $pegawai->tempat_lahir }}',
                                        editTglLahir:     '{{ $pegawai->tanggal_lahir }}',
                                        editAlamat:       '{{ addslashes($pegawai->alamat) }}',
                                        editNoTelp:       '{{ $pegawai->no_telp }}',
                                        editStatusNikah:  '{{ $pegawai->status_pernikahan }}',
                                        editJenisPegawai: '{{ $pegawai->jenis_pegawai }}',
                                        editIdJabatan:    '{{ $pegawai->id_jabatan }}',
                                        editIdDepartemen: '{{ $pegawai->id_departemen }}',
                                        editIdGolongan:   '{{ $pegawai->id_golongan }}',
                                        editIdPendidikan: '{{ $pegawai->id_pendidikan }}',
                                        editIdStatus:     '{{ $pegawai->id_status }}',
                                        editTglMasuk:     '{{ $pegawai->tanggal_masuk }}'
                                    })">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                {{-- Hapus --}}
                                <button type="button" class="btn-delete" title="Hapus"
                                    onclick="openModalHapusGeneric(
                                        'formHapusPegawai',
                                        'modalHapusPegawai',
                                        '{{ route('dataPegawai.delete', $pegawai->id) }}',
                                        '{{ addslashes($pegawai->nama_lengkap) }}',
                                        '{{ $pegawai->NIP }}'
                                    )">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 ms-5" style="color:#7a9a7a;">
                            Data pegawai tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-data-pegawai
        :jabatanList="$jabatanList"
        :departemenList="$departemenList"
        :statusList="$statusList"
        :golonganList="$golonganList"
        :pendidikanList="$pendidikanList"
    />

@endsection