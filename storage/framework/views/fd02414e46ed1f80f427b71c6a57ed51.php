<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['id', 'title', 'formTarget' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['id', 'title', 'formTarget' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="<?php echo e($id); ?>" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,0.65);">
    <div class="custom-card" style="border-radius:0.75rem;width:100%;margin:0 1rem;max-width:460px;">

        <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #1f1f1f;">
            <h5 style="color:#fff;font-weight:700;font-size:1rem;margin:0;"><?php echo e($title); ?></h5>
            <button onclick="closeModal('<?php echo e($id); ?>')" class="modal-close-btn">
                <i class="bi bi-x-lg" style="font-size:13px;"></i>
            </button>
        </div>

        <div style="padding:1rem 1.25rem;display:flex;flex-direction:column;gap:0.75rem;">
            <?php echo e($slot); ?>

        </div>

        <div style="display:flex;justify-content:flex-end;gap:0.5rem;padding:1rem 1.25rem;border-top:1px solid #1f1f1f;">
            <button onclick="closeModal('<?php echo e($id); ?>')" class="modal-btn-cancel" style="flex:none;">Batal</button>
            <button type="button" onclick="document.getElementById('<?php echo e($formTarget); ?>').submit()"
                style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;font-size:0.875rem;font-weight:600;color:#fff;cursor:pointer;border:none;background:#16a34a;">
                <i class="bi bi-check-lg"></i> Simpan Perubahan
            </button>
        </div>

    </div>
</div>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\modal\update.blade.php ENDPATH**/ ?>