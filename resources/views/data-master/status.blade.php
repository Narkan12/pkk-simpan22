@extends('layouts.layout-admin')

@section('title', 'Status')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Status Pegawai</h2>
        @can('create-data-master')
            <button class="btn-tambah-data" onclick="openModal('modalTambahStatus')">
                <i class="bi bi-plus"></i> Tambah Status Pegawai
            </button>
        @endcan
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-status" placeholder="Cari status pegawai...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-status">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA STATUS</th>
                    <th>DESKRIPSI</th>
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $status)
                    <tr>
                        <td>{{ $status->kode_status }}</td>
                        <td>
                            @php
                                $warnaStatus = match (strtolower($status->nama_status)) {
                                    'aktif' => 'status-active',
                                    'cuti' => 'status-cuti',
                                    'non-aktif', 'nonaktif' => 'status-nonaktif',
                                    'pensiun' => 'status-pensiun',
                                    'kontrak' => 'status-kontrak',
                                    default => 'status-lainnya',
                                };
                            @endphp
                            <span class="{{ $warnaStatus }}">{{ $status->nama_status }}</span>
                        </td>
                        <td>{{ $status->deskripsi ?? '-' }}</td>
                        <td>
                            @can('edit-data-master')
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditStatus', 'modalEditStatus', {
                            action: '/status/{{ $status->id }}',
                            editKodeStatus: '{{ $status->kode_status }}',
                            editNamaStatus: '{{ $status->nama_status }}',
                            editDeskripsiStatus: '{{ $status->deskripsi }}'
                        })"><i class="bi bi-pencil-fill"></i></button>
                            @endcan

                            @can('delete-data-master')
                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                            'formHapusStatus',
                            'modalHapusStatus',
                            '/status/{{ $status->id }}',
                            '{{ $status->nama_status }}',
                            '{{ $status->kode_status }}'
                        )"><i class="bi bi-trash-fill"></i></button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;color:#7a9a7a;padding:1rem;">Belum ada data status.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal-layout.modal-status></x-modal-layout.modal-status>

@endsection
