@extends('layouts.layout-admin')

@section('title', 'Golongan')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <h2 style="font-size:1.5rem;font-weight:600;color:#fff;">Data Golongan</h2>
        <button class="btn-tambah-data" onclick="openModal('modalTambahGolongan')">
            <i class="bi bi-plus"></i> Tambah Golongan
        </button>
    </div>

    <div class="search-wrapper mt-4">
        <i class="bi bi-search"></i>
        <input type="text" id="search-golongan" placeholder="Cari golongan...">
    </div>

    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-golongan">
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>NAMA GOLONGAN</th>
                    <th>PANGKAT</th>
                    <th>RUANG</th>
                    <th>ESELON</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $golongan)
                    <tr>
                        <td>{{ $golongan->kode_golongan }}</td>
                        <td class="font-semibold" style="color:#e6edf3;">{{ $golongan->nama_golongan }}</td>
                        <td>{{ $golongan->pangkat }}</td>
                        <td>{{ $golongan->ruang }}</td>
                        <td>{{ $golongan->eselon }}</td>

                        <td>
                            <button class="btn-view"
                                onclick="openModalEditGeneric('formEditGolongan', 'modalEditGolongan', {
                        action: '/golongan/{{ $golongan->id }}',
                        editKodeGolongan: '{{ $golongan->kode_golongan }}',
                        editNamaGolongan: '{{ $golongan->nama_golongan }}',
                        editPangkatGolongan: '{{ $golongan->pangkat }}',
                        editRuangGolongan: '{{ $golongan->ruang }}',
                        editEselonGolongan: '{{ $golongan->eselon }}'
                    })""><i class="bi bi-pencil-fill"></i></button>

                            <button class="btn-delete"
                                onclick="openModalHapusGeneric(
                        'formHapusGolongan',
                        'modalHapusGolongan',
                        '/golongan/{{ $golongan->id }}',
                        '{{ $golongan->nama_golongan }}',
                        '{{ $golongan->kode_golongan }}'
                    )"><i
                                    class="bi bi-trash-fill"></i></button>
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

    <x-modal-layout.modal-golongan></x-modal-layout.modal-golongan>
@endsection
