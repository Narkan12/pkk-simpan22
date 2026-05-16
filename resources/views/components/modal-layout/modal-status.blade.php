{{-- MODAL ADD --}}
<x-modal.add id="modalTambahStatus" title="Tambah Status" formTarget="formTambahStatus">
    <form id="formTambahStatus" method="POST" action="{{ route('status.insert') }}" class="contents">
        @csrf
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_status" placeholder="Contoh: ST-06"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Status <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_status" placeholder="Contoh: Aktif"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Deskripsi</label>
            <input type="text" name="deskripsi" placeholder="Deskripsi singkat status"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.add>

{{-- MODAL EDIT --}}
<x-modal.update id="modalEditStatus" title="Edit Status" formTarget="formEditStatus">
    <form id="formEditStatus" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_status" id="editKodeStatus" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Status <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_status" id="editNamaStatus" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Deskripsi</label>
            <input type="text" name="deskripsi" id="editDeskripsiStatus" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.update>

{{-- MODAL HAPUS --}}
<x-modal.delete id="modalHapusStatus" title="Hapus Status" formId="formHapusStatus">
    <form method="POST" id="formHapusStatus" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
