
<?php if (isset($component)) { $__componentOriginal7798093c4a64f2ca6baa1b3744349deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.add','data' => ['id' => 'modalTambahKomponenGaji','title' => 'Tambah Komponen Gaji','formTarget' => 'formTambahKomponenGaji']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.add'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalTambahKomponenGaji','title' => 'Tambah Komponen Gaji','formTarget' => 'formTambahKomponenGaji']); ?>
    <form id="formTambahKomponenGaji" method="POST" action="<?php echo e(route('komponen-gaji.insert')); ?>" class="contents">
        <?php echo csrf_field(); ?>
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
                <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($jab->id); ?>"><?php echo e($jab->nama_jabatan); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7798093c4a64f2ca6baa1b3744349deb)): ?>
<?php $attributes = $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb; ?>
<?php unset($__attributesOriginal7798093c4a64f2ca6baa1b3744349deb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7798093c4a64f2ca6baa1b3744349deb)): ?>
<?php $component = $__componentOriginal7798093c4a64f2ca6baa1b3744349deb; ?>
<?php unset($__componentOriginal7798093c4a64f2ca6baa1b3744349deb); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginaldb0d68c8f75c99077e7217096a8bcb0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb0d68c8f75c99077e7217096a8bcb0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.update','data' => ['id' => 'modalEditKomponenGaji','title' => 'Edit Komponen Gaji','formTarget' => 'formEditKomponenGaji']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalEditKomponenGaji','title' => 'Edit Komponen Gaji','formTarget' => 'formEditKomponenGaji']); ?>
    <form id="formEditKomponenGaji" method="POST" action="" class="contents">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
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
                <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($jab->id); ?>"><?php echo e($jab->nama_jabatan); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb0d68c8f75c99077e7217096a8bcb0a)): ?>
<?php $attributes = $__attributesOriginaldb0d68c8f75c99077e7217096a8bcb0a; ?>
<?php unset($__attributesOriginaldb0d68c8f75c99077e7217096a8bcb0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb0d68c8f75c99077e7217096a8bcb0a)): ?>
<?php $component = $__componentOriginaldb0d68c8f75c99077e7217096a8bcb0a; ?>
<?php unset($__componentOriginaldb0d68c8f75c99077e7217096a8bcb0a); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal2b3245a5746dec4123f46f887cebc745 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b3245a5746dec4123f46f887cebc745 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.delete','data' => ['id' => 'modalHapusKomponenGaji','title' => 'Hapus Komponen Gaji','formId' => 'formHapusKomponenGaji']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalHapusKomponenGaji','title' => 'Hapus Komponen Gaji','formId' => 'formHapusKomponenGaji']); ?>
    <form method="POST" id="formHapusKomponenGaji" action="">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b3245a5746dec4123f46f887cebc745)): ?>
<?php $attributes = $__attributesOriginal2b3245a5746dec4123f46f887cebc745; ?>
<?php unset($__attributesOriginal2b3245a5746dec4123f46f887cebc745); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b3245a5746dec4123f46f887cebc745)): ?>
<?php $component = $__componentOriginal2b3245a5746dec4123f46f887cebc745; ?>
<?php unset($__componentOriginal2b3245a5746dec4123f46f887cebc745); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-komponen-gaji.blade.php ENDPATH**/ ?>