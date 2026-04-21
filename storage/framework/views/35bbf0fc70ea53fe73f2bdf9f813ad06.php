
<?php if (isset($component)) { $__componentOriginal7798093c4a64f2ca6baa1b3744349deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.add','data' => ['id' => 'modalTambahJabatan','title' => 'Tambah Jabatan','formTarget' => 'formTambahJabatan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.add'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalTambahJabatan','title' => 'Tambah Jabatan','formTarget' => 'formTambahJabatan']); ?>
        <form id="formTambahJabatan" method="POST" action="<?php echo e(route('jabatan.insert')); ?>" class="contents">
        <?php echo csrf_field(); ?>
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
                <?php for($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                <?php endfor; ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.update','data' => ['id' => 'modalEditJabatan','title' => 'Edit Jabatan','formTarget' => 'formEditJabatan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalEditJabatan','title' => 'Edit Jabatan','formTarget' => 'formEditJabatan']); ?>    <form id="formEditJabatan" method="POST" action="" class="contents">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
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
                <?php for($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                <?php endfor; ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.delete','data' => ['id' => 'modalHapusJabatan','title' => 'Hapus Jabatan','formId' => 'formHapusJabatan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalHapusJabatan','title' => 'Hapus Jabatan','formId' => 'formHapusJabatan']); ?>
    <form method="POST" id="formHapusJabatan" action="">
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
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-jabatan.blade.php ENDPATH**/ ?>