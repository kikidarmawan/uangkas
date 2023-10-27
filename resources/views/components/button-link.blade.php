@props(['icon', 'title', 'route', 'type'])
@php
    $class = '';
@endphp
@if ($type == 'primary')
    @php
        $class = 'btn btn-primary';
    @endphp
@elseif ($type == 'secondary')
    @php
        $class = 'btn btn-secondary';
    @endphp
@elseif ($type == 'success')
    @php
        $class = 'btn btn-success';
    @endphp
@elseif ($type == 'danger')
    @php
        $class = 'btn btn-danger';
    @endphp
@elseif ($type == 'warning')
    @php
        $class = 'btn btn-warning';
    @endphp
@endif
<a href="{{ $route }}" title="{{ $title }}" {{ $attributes->merge(['class' => $class]) }}>
    <x-icon-feather icon="{{ $icon }}" class="" />
    {{ $slot }}
</a>
