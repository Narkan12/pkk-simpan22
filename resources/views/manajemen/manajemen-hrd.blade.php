{{-- [DISEDERHANAKAN] Logika sama persis, hanya penulisan yang dibuat lebih ringkas dan mudah dibaca --}}
@extends('layouts.layout-admin')

@section('title', 'Manajemen HRD')

@section('content')

    {{-- Header --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.5rem;margin-bottom:1rem;">
        <div>
            <h4 style="color:#fff;font-weight:700;font-size:1.5rem;margin-bottom:0.25rem;">Manajemen HRD</h4>
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Kelola akun pengguna dengan role HRD</p>
        </div>
        {{-- tombol tambah hanya untuk admin --}}
        @can('create-hrd')
            <button class="btn-tambah-data" onclick="openModal('modalTambahHrd')">
                <i class="bi bi-plus"></i> Tambah HRD
            </button>
        @endcan
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

    {{-- Info card jumlah HRD --}}
    <div style="display:inline-flex;align-items:center;gap:0.75rem;border-radius:0.75rem;padding:1rem 1.5rem;border:1px solid rgba(3,201,80,0.3);background:rgba(3,201,80,0.08);margin-bottom:1rem;">
        <i class="bi bi-person-badge-fill" style="color:#03C950;font-size:1.5rem;"></i>
        <div>
            <p style="color:#03C950;font-size:0.8rem;font-weight:600;margin:0;">Total Akun HRD</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">{{ $hrdList->count() }}</h3>
        </div>
    </div>

    {{-- Tabel daftar HRD --}}
    <div class="table-dark-custom">
        <table class="w-full datatable">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>DIBUAT</th>
                    {{-- kolom aksi hanya tampil jika admin atau owner --}}
                    <th data-sortable="false">AKSI</th>
                </tr>
            </thead>
            <tbody>
                {{-- tampilan jika data kosong --}}
                @forelse($hrdList as $hrd)
                    <tr>
                        <td style="font-weight:600;color:#1a2e1a;">{{ $hrd->name }}</td>
                        <td>
                            <span style="background:rgba(3,201,80,0.1);color:#03C950;padding:2px 8px;border-radius:4px;font-size:0.8rem;font-weight:600;">
                                {{ $hrd->username }}
                            </span>
                        </td>
                        <td style="color:#7a9a7a;">{{ $hrd->email }}</td>
                        <td style="color:#7a9a7a;font-size:0.8rem;">{{ $hrd->created_at->isoFormat('D MMM Y') }}</td>
                        <td>
                            <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;">

                                {{-- tombol edit hanya admin --}}
                                @can('edit-hrd')
                                    <button type="button" class="btn-view" title="Edit"
                                        onclick="openEditHrd({{ $hrd->id }}, '{{ addslashes($hrd->name) }}', '{{ addslashes($hrd->username) }}', '{{ $hrd->email }}')">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                @endcan

                                {{-- tombol hapus hanya admin --}}
                                @can('delete-hrd')
                                    <form action="{{ route('hrd.destroy', $hrd->id) }}" method="POST" style="display:inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus akun HRD {{ addslashes($hrd->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endcan

                                {{-- owner hanya lihat, tidak ada tombol aksi --}}
                                @if(Auth::user()->role === 'owner')
                                    <span style="color:#7a9a7a;font-size:0.75rem;font-style:italic;">Hanya lihat</span>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:2.5rem 1rem;color:#7a9a7a;">
                            Belum ada akun HRD terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== MODAL TAMBAH HRD ===== --}}
    @can('create-hrd')
    <div id="modalTambahHrd" class="hidden"
        style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <div class="modal-dark" style="max-width:460px;width:100%;">
            <form action="{{ route('hrd.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <p class="modal-title">Tambah Akun HRD</p>
                    <button type="button" onclick="closeModal('modalTambahHrd')" class="modal-close-btn">
                        <i class="bi bi-x-lg" style="font-size:11px;"></i>
                    </button>
                </div>

                <div class="modal-body" style="display:flex;flex-direction:column;gap:0.875rem;">

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Nama Lengkap <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="text" name="name" placeholder="Nama lengkap HRD" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Username <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="text" name="username" placeholder="Contoh: hrd01" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Email <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="email" name="email" placeholder="email@contoh.com" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Password <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="password" name="password" placeholder="Min. 6 karakter" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('modalTambahHrd')" class="modal-btn-cancel">Batal</button>
                    <button type="submit"
                        style="padding:0.5rem 1.25rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#1a5c2e;">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endcan

    {{-- ===== MODAL EDIT HRD ===== --}}
    @can('edit-hrd')
    <div id="modalEditHrd" class="hidden"
        style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <div class="modal-dark" style="max-width:460px;width:100%;">
            <form id="formEditHrd" method="POST" action="">
                @csrf @method('PUT')

                <div class="modal-header">
                    <p class="modal-title">Edit Akun HRD</p>
                    <button type="button" onclick="closeModal('modalEditHrd')" class="modal-close-btn">
                        <i class="bi bi-x-lg" style="font-size:11px;"></i>
                    </button>
                </div>

                <div class="modal-body" style="display:flex;flex-direction:column;gap:0.875rem;">

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Nama Lengkap <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="text" name="name" id="editHrdName" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Username <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="text" name="username" id="editHrdUsername" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Email <span style="color:#e05c5c;">*</span>
                        </label>
                        <input type="email" name="email" id="editHrdEmail" class="modal-input"
                            style="width:100%;font-size:0.875rem;" required>
                    </div>

                    <div>
                        <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">
                            Password Baru <span style="color:#7a9a7a;">(kosongkan jika tidak diubah)</span>
                        </label>
                        <input type="password" name="password" placeholder="Min. 6 karakter" class="modal-input"
                            style="width:100%;font-size:0.875rem;">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" onclick="closeModal('modalEditHrd')" class="modal-btn-cancel">Batal</button>
                    <button type="submit"
                        style="padding:0.5rem 1.25rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#1a5c2e;">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endcan

    <script>
    // isi form edit HRD dengan data yang dipilih
    function openEditHrd(id, name, username, email) {
        document.getElementById('editHrdName').value     = name;
        document.getElementById('editHrdUsername').value = username;
        document.getElementById('editHrdEmail').value    = email;
        document.getElementById('formEditHrd').action    = '/manajemen-hrd/' + id;
        openModal('modalEditHrd');
    }
    </script>

@endsection
