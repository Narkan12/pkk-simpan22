@props([
    'href'     => '#',
    'icon'     => 'bi-circle',
    'route'    => null,
    'dropdown' => false,
])

@php
    $routeName = $route ?? ltrim($href, '/');
    $isActive  = request()->routeIs($routeName);
    $class     = $dropdown ? 'item-dropdown' : 'nav-item';
@endphp

<a href="{{ $href }}" class="{{ $class }} {{ $isActive ? 'active' : '' }}">
    <i class="bi {{ $icon }} {{ $dropdown ? 'me-2' : 'nav-icon' }}" @if($dropdown) style="color:#8fc4b3;" @endif></i>
    <span @if(!$dropdown) class="sidebar-text" style="margin-left:0.75rem;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" @endif>{{ $slot }}</span>
</a>
