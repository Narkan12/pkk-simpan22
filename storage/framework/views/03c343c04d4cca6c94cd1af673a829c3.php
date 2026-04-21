
<?php if (isset($component)) { $__componentOriginal7798093c4a64f2ca6baa1b3744349deb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7798093c4a64f2ca6baa1b3744349deb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.add','data' => ['id' => 'modalTambahGolongan','title' => 'Tambah Golongan','formTarget' => 'formTambahGolongan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.add'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalTambahGolongan','title' => 'Tambah Golongan','formTarget' => 'formTambahGolongan']); ?>
    <form id="formTambahGolongan" method="POST" action="<?php echo e(route('golongan.insert')); ?>" class="contents">
        <?php echo csrf_field(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.update','data' => ['id' => 'modalEditGolongan','title' => 'Edit Golongan','formTarget' => 'formEditGolongan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalEditGolongan','title' => 'Edit Golongan','formTarget' => 'formEditGolongan']); ?>
    <form id="formEditGolongan" method="POST" action="" class="contents">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.delete','data' => ['id' => 'modalHapusGolongan','title' => 'Hapus Golongan','formId' => 'formHapusGolongan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modalHapusGolongan','title' => 'Hapus Golongan','formId' => 'formHapusGolongan']); ?>
    <form method="POST" id="formHapusGolongan" action="">
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
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal-layout\modal-golongan.blade.php ENDPATH**/ ?>