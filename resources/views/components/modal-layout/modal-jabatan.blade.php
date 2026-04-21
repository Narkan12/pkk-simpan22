{{-- MODAL TAMBAH --}}
<x-modal.add id="modalTambahJabatan" title="Tambah Jabatan" formTarget="formTambahJabatan">
        <form id="formTambahJabatan" method="POST" action="{{ route('jabatan.insert') }}" class="contents">
        @csrf
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode Jabatan <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_jabatan" placeholder="Contoh: MGR-01"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Jabatan <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_jabatan" placeholder="Contoh: Manager IT"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Level <span style="color:#e05c5c;">*</span></label>
            <select name="level" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                <option value="">Pilih Level</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Gaji Pokok</label>
            <div class="modal-input" style="display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#8b949e;font-size:0.875rem;flex-shrink:0;">Rp</span>
                <input type="number" name="gaji_pokok" placeholder="0"
                    style="background:transparent;border:none;outline:none;font-size:0.875rem;width:100%;color:#c9d1d9;">
            </div>
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tunjangan</label>
            <div class="modal-input" style="display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#8b949e;font-size:0.875rem;flex-shrink:0;">Rp</span>
                <input type="number" name="tunjangan" placeholder="0"
                    style="background:transparent;border:none;outline:none;font-size:0.875rem;width:100%;color:#c9d1d9;">
            </div>
        </div>
    </form>
</x-modal.add>

{{-- MODAL EDIT --}}
<x-modal.update id="modalEditJabatan" title="Edit Jabatan" formTarget="formEditJabatan">    <form id="formEditJabatan" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode Jabatan <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_jabatan" id="editKode"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Jabatan <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_jabatan" id="editNama"
                class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Level <span style="color:#e05c5c;">*</span></label>
            <select name="level" id="editLevel" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Gaji Pokok</label>
            <div class="modal-input" style="display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#8b949e;font-size:0.875rem;flex-shrink:0;">Rp</span>
                <input type="number" name="gaji_pokok" id="editGajiPokok"
                    style="background:transparent;border:none;outline:none;font-size:0.875rem;width:100%;color:#c9d1d9;">
            </div>
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tunjangan</label>
            <div class="modal-input" style="display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#8b949e;font-size:0.875rem;flex-shrink:0;">Rp</span>
                <input type="number" name="tunjangan" id="editTunjangan"
                    style="background:transparent;border:none;outline:none;font-size:0.875rem;width:100%;color:#c9d1d9;">
            </div>
        </div>
    </form>
</x-modal.update>

{{-- MODAL HAPUS --}}
<x-modal.delete id="modalHapusJabatan" title="Hapus Jabatan" formId="formHapusJabatan">
    <form method="POST" id="formHapusJabatan" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
