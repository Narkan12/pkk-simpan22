<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'href'     => '#',
    'icon'     => 'bi-circle',
    'route'    => null,
    'dropdown' => false,
]));

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

foreach (array_filter(([
    'href'     => '#',
    'icon'     => 'bi-circle',
    'route'    => null,
    'dropdown' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $routeName = $route ?? ltrim($href, '/');
    $isActive  = request()->routeIs($routeName);
    $class     = $dropdown ? 'item-dropdown' : 'nav-item';
?>

<a href="<?php echo e($href); ?>" class="<?php echo e($class); ?> <?php echo e($isActive ? 'active' : ''); ?>">
    <i class="bi <?php echo e($icon); ?> <?php echo e($dropdown ? 'me-2' : 'nav-icon'); ?>" <?php if($dropdown): ?> style="color:#8fc4b3;" <?php endif; ?>></i>
    <span <?php if(!$dropdown): ?> class="sidebar-text" style="margin-left:0.75rem;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" <?php endif; ?>><?php echo e($slot); ?></span>
</a>
<?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\components\sidebar-active.blade.php ENDPATH**/ ?>