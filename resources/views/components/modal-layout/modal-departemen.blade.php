{{-- Modal Add --}}
<x-modal.add id="modalTambahDepartemen" title="Tambah Departemen" formTarget="formTambahDepartemen">
    <form id="formTambahDepartemen" method="POST" action="{{ route('departemen.insert') }}" class="contents">
        @csrf
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_departemen" placeholder="Contoh: DEPT-IT"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Departemen <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_departemen" placeholder="Contoh: Teknologi Informasi"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kepala Departemen</label>
            <input type="text" name="kepala_departemen" placeholder="Nama kepala dept."
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Lokasi</label>
            <input type="text" name="lokasi" placeholder="Contoh: Gedung A Lt. 3"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.add>

{{-- Modal Update --}}
<x-modal.update id="modalEditDepartemen" title="Edit Departemen" formTarget="formEditDepartemen">
    <form id="formEditDepartemen" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_departemen" id="editKodeDept" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Departemen <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_departemen" id="editNamaDept" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kepala Departemen</label>
            <input type="text" name="kepala_departemen" id="editKepalaDept" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Lokasi</label>
            <input type="text" name="lokasi" id="editLokasiDept" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
    </form>
</x-modal.update>

{{-- Modal Delete --}}
<x-modal.delete id="modalHapusDepartemen" title="Hapus Departemen" formId="formHapusDepartemen">
    <form method="POST" id="formHapusDepartemen" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
