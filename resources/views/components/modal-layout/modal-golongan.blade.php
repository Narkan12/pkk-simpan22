{{-- MODAL ADD --}}
<x-modal.add id="modalTambahGolongan" title="Tambah Golongan" formTarget="formTambahGolongan">
    <form id="formTambahGolongan" method="POST" action="{{ route('golongan.insert') }}" class="contents">
        @csrf
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode / Golongan <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_golongan" placeholder="Contoh: III/b"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Golongan <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_golongan" placeholder="Contoh: Golongan III/b"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Pangkat <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="pangkat" placeholder="Contoh: Penata Muda Tk.I"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Ruang</label>
            <input type="text" name="ruang" placeholder="Contoh: III/b"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Eselon</label>
            <input type="text" name="eselon" placeholder="Contoh: Eselon III"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.add>

{{-- MODAL EDIT --}}
<x-modal.update id="modalEditGolongan" title="Edit Golongan" formTarget="formEditGolongan">
    <form id="formEditGolongan" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode / Golongan <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_golongan" id="editKodeGolongan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Golongan <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_golongan" id="editNamaGolongan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Pangkat <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="pangkat" id="editPangkatGolongan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Ruang</label>
            <input type="text" name="ruang" id="editRuangGolongan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Eselon</label>
            <input type="text" name="eselon" id="editEselonGolongan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.update>

{{-- MODAL HAPUS --}}
<x-modal.delete id="modalHapusGolongan" title="Hapus Golongan" formId="formHapusGolongan">
    <form method="POST" id="formHapusGolongan" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
