@extends('layouts.layout-admin')

@section('title', 'Jabatan')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Jabatan</h2>
        @can('create-data-master')
            <button class="btn-tambah-data" onclick="openModal('modalTambahJabatan')">
                <i class="bi bi-plus"></i> Tambah Jabatan
            </button>
        @endcan
    </div>

    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-jabatan" placeholder="Cari jabatan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-jabatan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA JABATAN</th>
                    <th>LEVEL</th>
                    <th>GAJI POKOK</th>
                    <th>TUNJANGAN</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $jabatan)
            <tr>
                <td>{{ $jabatan->kode_jabatan }}</td>
                <td><span class="status-jabatan">{{ $jabatan->nama_jabatan }}</span></td>
                <td>{{ $jabatan->level }}</td>
                <td>Rp {{ number_format($jabatan->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($jabatan->tunjangan ?? 0, 0, ',', '.') }}</td>
                <td>
                    @can('edit-data-master')
                    <button class="btn-view" onclick="openModalEditGeneric('formEditJabatan', 'modalEditJabatan', {
                        action: '/jabatan/{{ $jabatan->id }}',
                        editKode: '{{ $jabatan->kode_jabatan }}',
                        editNama: '{{ $jabatan->nama_jabatan }}',
                        editLevel: '{{ $jabatan->level }}',
                        editGajiPokok: '{{ $jabatan->gaji_pokok ?? 0 }}',
                        editTunjangan: '{{ $jabatan->tunjangan ?? 0 }}'
                    })"><i class="bi bi-pencil-fill"></i></button>
                    @endcan

                    @can('delete-data-master')
                    <button class="btn-delete" onclick="openModalHapusGeneric(
                        'formHapusJabatan',
                        'modalHapusJabatan',
                        '/jabatan/{{ $jabatan->id }}',
                        '{{ $jabatan->nama_jabatan }}',
                        '{{ $jabatan->kode_jabatan }}'
                    )"><i class="bi bi-trash-fill"></i></button>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data jabatan.</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-jabatan></x-modal-layout.modal-jabatan>

@endsection