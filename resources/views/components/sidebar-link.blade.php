@props(['icon', 'title', 'route'])


<a class="d-flex align-items-center" href="{{ $route }}">
    <x-icon-feather icon="{{ $icon }}" class="me-2" />
    <span class="menu-title text-truncate">{{ $slot }}</span>
</a>
