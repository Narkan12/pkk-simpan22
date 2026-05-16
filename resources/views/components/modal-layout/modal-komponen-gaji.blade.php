{{-- MODAL KOMPONEN GAJI ADD --}}
<x-modal.add id="modalTambahKomponenGaji" title="Tambah Komponen Gaji" formTarget="formTambahKomponenGaji">
    <form id="formTambahKomponenGaji" method="POST" action="{{ route('komponen-gaji.insert') }}" class="contents">
        @csrf
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_komponen" placeholder="Contoh: TJ-04" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Komponen
                <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_komponen" placeholder="Contoh: Tunjangan Lembur" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis <span
                    style="color:#e05c5c;">*</span></label>
            <select name="jenis" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                <option value="">Pilih Jenis</option>
                <option value="penghasilan">Penghasilan</option>
                <option value="potongan">Potongan</option>
            </select>
        </div>

        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tipe Nominal
                <span style="color:#e05c5c;">*</span></label>
            <select name="tipe_nominal" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                <option value="">Pilih Tipe</option>
                <option value="fixed">Fixed (Nominal Tetap)</option>
                <option value="percent">Percent (Persentase)</option>
            </select>
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nominal <span
                    style="color:#e05c5c;">*</span></label>
            <input type="number" name="nominal" placeholder="Contoh: 500000" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Berlaku Untuk
                Jabatan <span style="color:#e05c5c;">*</span></label>
            <select name="id_jabatan" class="modal-input" style="width:100%;font-size:0.875rem;color:#c9d1d9;" required>
                <option value="">Pilih Jabatan</option>
                @foreach ($jabatan as $jab)
                    <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
    </form>
</x-modal.add>

{{-- MODAL KOMPONEN GAJI EDIT --}}
<x-modal.update id="modalEditKomponenGaji" title="Edit Komponen Gaji" formTarget="formEditKomponenGaji">
    <form id="formEditKomponenGaji" method="POST" action="" class="contents">
        @csrf
        @method('PUT')
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Kode <span
                    style="color:#e05c5c;">*</span></label>
            <input type="text" name="kode_komponen" id="editKodeKomponen" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nama Komponen
                <span style="color:#e05c5c;">*</span></label>
            <input type="text" name="nama_komponen" id="editNamaKomponen" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis <span
                    style="color:#e05c5c;">*</span></label>
            <select name="jenis" id="editJenisKomponen" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                <option value="Penghasilan">Penghasilan</option>
                <option value="Potongan">Potongan</option>
            </select>
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tipe Nominal
                <span style="color:#e05c5c;">*</span></label>
            <select name="tipe_nominal" id="editTipeNominal" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
                <option value="Fixed">Fixed</option>
                <option value="Percent">Percent</option>
            </select>
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Nominal
                <span style="color:#e05c5c;">*</span></label>
            <input type="number" name="nominal" id="editNominal" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;">
        </div>
        <div style="grid-column:span 2;">
            <label class="custom-paragraph" style="font-size:0.75rem;margin-bottom:0.25rem;display:block;">Berlaku
                Untuk Jabatan <span style="color:#e05c5c;">*</span></label>
            <select name="id_jabatan" id="editIdJabatan" class="modal-input"
                style="width:100%;font-size:0.875rem;color:#c9d1d9;" required>
                @foreach ($jabatan as $jab)
                    <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
    </form>
</x-modal.update>

{{-- MODAL KOMPONEN GAJI HAPUS --}}
<x-modal.delete id="modalHapusKomponenGaji" title="Hapus Komponen Gaji" formId="formHapusKomponenGaji">
    <form method="POST" id="formHapusKomponenGaji" action="">
        @csrf
        @method('DELETE')
    </form>
</x-modal.delete>
