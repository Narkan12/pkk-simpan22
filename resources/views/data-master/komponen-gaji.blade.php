@extends('layouts.layout-admin')

@section('title', 'Komponen Gaji')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Komponen Gaji</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahKomponenGaji')">
            <i class="bi bi-plus"></i> Tambah Komponen
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-komponen-gaji" placeholder="Cari komponen gaji...">
    </div>

    @if ($errors->any())
        <div class="alert-error" style="margin-bottom:1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-komponen-gaji">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA KOMPONEN</th>
                    <th>JENIS</th>
                    <th>TIPE NOMINAL</th>
                    <th>NOMINAL</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $komponen)
                    <tr>
                        <td>{{ $komponen->kode_komponen }}</td>
                        <td class="font-semibold" style="color:#e6edf3;">{{ $komponen->nama_komponen }}</td>
                        <td>
                            @php
                                $JenisKomponen = match ($komponen->jenis) {
                                    'Penghasilan' => 'status-penghasilan',
                                    'Potongan' => 'status-potongan',
                                    default => 'status-lainnya',
                                };
                            @endphp
                            <span class="{{ $JenisKomponen }}">{{ $komponen->jenis }}</span>
                        </td>
                        <td>
                            {{ $komponen->tipe_nominal == 'percent' ? 'Persentase (%)' : 'Rupiah (Rp)' }}
                        </td>
                        <td>
                            {{ $komponen->tipe_nominal == 'percent'
                                ? $komponen->nominal . '%'
                                : 'Rp ' . number_format($komponen->nominal, 0, ',', '.') }}
                        </td>
                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditKomponenGaji', 'modalEditKomponenGaji', {
                                    action: '/komponen-gaji/{{ $komponen->id }}',
                                    editKodeKomponen: '{{ $komponen->kode_komponen }}',
                                    editNamaKomponen: '{{ $komponen->nama_komponen }}',
                                    editJenisKomponen: '{{ $komponen->jenis }}',
                                    editTipeNominal: '{{ $komponen->tipe_nominal }}',
                                    editNominal: '{{ $komponen->nominal }}',
                                    editIdJabatan: '{{ $komponen->id_jabatan }}'
                                })">
                                <i class="bi bi-pencil-fill"></i>
                            </button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                                    'formHapusKomponenGaji',
                                    'modalHapusKomponenGaji',
                                    '/komponen-gaji/{{ $komponen->id }}',
                                    '{{ $komponen->nama_komponen }}',
                                    '{{ $komponen->kode_komponen }}'
                                )">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data komponen gaji.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-komponen-gaji :jabatan="$jabatan"
    ></x-modal-layout.modal-komponen-gaji>

@endsection
