@extends('layouts.layout-admin')

@section('title', 'Departemen')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Departemen</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahDepartemen')">
            <i class="bi bi-plus"></i> Tambah Departemen
        </button>
    </div>

    <div class="search-wrapper">
        <i class="bi bi-search"></i>
        <input type="text" id="search-departemen" placeholder="Cari departemen...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-departemen">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA DEPARTEMEN</th>
                    <th>KEPALA DEPARTEMEN</th>
                    <th>JUMLAH PEGAWAI</th>
                    <th>LOKASI</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $departemen)
                <tr>
                    <td>{{ $departemen->kode_departemen }}</td>
                    <td><span class="status-departemen">{{ $departemen->nama_departemen }}</span></td>
                    <td>{{ $departemen->kepala_departemen ?? '-' }}</td>
                    <td>-</td>
                    <td>{{ $departemen->lokasi ?? '-' }}</td>
                    <td>
                        <button class="btn-view" onclick="openModalEditGeneric('formEditDepartemen', 'modalEditDepartemen', {
                            action: '/departemen/{{ $departemen->id }}',
                            editKodeDept: '{{ $departemen->kode_departemen }}',
                            editNamaDept: '{{ $departemen->nama_departemen }}',
                            editKepalaDept: '{{ $departemen->kepala_departemen }}',
                            editLokasiDept: '{{ $departemen->lokasi }}'
                        })"><i class="bi bi-pencil-fill"></i></button>

                        <button class="btn-delete" onclick="openModalHapusGeneric(
                            'formHapusDepartemen',
                            'modalHapusDepartemen',
                            '/departemen/{{ $departemen->id }}',
                            '{{ $departemen->nama_departemen }}',
                            '{{ $departemen->kode_departemen }}'
                        )"><i class="bi bi-trash-fill"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data departemen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-departemen></x-modal-layout.modal-departemen>

@endsection