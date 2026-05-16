@extends('layouts.layout-admin')

@section('title', 'Pendidikan')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Pendidikan Karyawan</h2>
        @can('create-data-master')
            <button class="btn-tambah-data" onclick="openModal('modalTambahPendidikan')">
                <i class="bi bi-plus"></i> Tambah Pendidikan
            </button>
        @endcan
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-pendidikan" placeholder="Cari pendidikan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-pendidikan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>JENJANG</th>
                    <th>DESKRIPSI</th>
                    <th>LAMA STUDI (TAHUN)</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $pendidikan)
                    <tr>
                        <td>{{ $pendidikan->kode_pendidikan }}</td>
        <td class="font-semibold" style="color:#e6edf3;">{{ $pendidikan->jenjang }}</td>
                        <td>{{ $pendidikan->deskripsi ?? '-' }}</td>
                        <td>{{ $pendidikan->lama_studi }}</td>
                        <td>
                            @can('edit-data-master')
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditPendidikan', 'modalEditPendidikan', {
                                action: '/pendidikan/{{ $pendidikan->id }}',
                                editKodePendidikan: '{{ $pendidikan->kode_pendidikan }}',
                                editJenjangPendidikan: '{{ $pendidikan->jenjang }}',
                                editDeskripsiPendidikan: '{{ $pendidikan->deskripsi }}',
                                editLamaStudiPendidikan: '{{ $pendidikan->lama_studi }}'
                            })"><i class="bi bi-pencil-fill"></i></button>
                            @endcan

                            @can('delete-data-master')
                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                                'formHapusPendidikan',
                                'modalHapusPendidikan',
                                '/pendidikan/{{ $pendidikan->id }}',
                                '{{ $pendidikan->jenjang }}',
                                '{{ $pendidikan->kode_pendidikan }}'
                            )"><i class="bi bi-trash-fill"></i></button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data pendidikan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-pendidikan></x-modal-layout.modal-pendidikan>

@endsection