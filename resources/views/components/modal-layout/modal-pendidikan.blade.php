{{-- MODAL ADD --}}
<x-modal.add id="modalTambahPendidikan" title="Tambah Pendidikan" formTarget="formTambahPendidikan">
    <form id="formTambahPendidikan" method="POST" action="{{ route('pendidikan.insert') }}" class="contents">
        @csrf
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_pendidikan" placeholder="Contoh: P-01"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenjang <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="jenjang" placeholder="Contoh: S1 / Sarjana"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Deskripsi</label>
            <input type="text" name="deskripsi" placeholder="Contoh: Pendidikan Strata 1"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Lama Studi (Tahun)</label>
            <input type="number" name="lama_studi" placeholder="Contoh: 4"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.add>

{{-- MODAL EDIT --}}
<x-modal.update id="modalEditPendidikan" title="Edit Pendidikan" formTarget="formEditPendidikan">
    <form id="formEditPendidikan" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_pendidikan" id="editKodePendidikan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenjang <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="jenjang" id="editJenjangPendidikan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Deskripsi</label>
            <input type="text" name="deskripsi" id="editDeskripsiPendidikan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Lama Studi (Tahun)</label>
            <input type="number" name="lama_studi" id="editLamaStudiPendidikan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.update>

{{-- MODAL HAPUS --}}
<x-modal.delete id="modalHapusPendidikan" title="Hapus Pendidikan" formId="formHapusPendidikan">
    <form method="POST" id="formHapusPendidikan" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
