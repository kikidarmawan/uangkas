@props(['title', 'route', 'type', 'color', 'id'])
@php
    $class = '';
@endphp
@if ($color == 'primary')
    @php
        $class = 'btn btn-primary';
    @endphp
@elseif ($color == 'secondary')
    @php
        $class = 'btn btn-secondary';
    @endphp
@elseif ($color == 'success')
    @php
        $class = 'btn btn-success';
    @endphp
@elseif ($color == 'danger')
    @php
        $class = 'btn btn-danger';
    @endphp
@elseif ($color == 'warning')
    @php
        $class = 'btn btn-warning';
    @endphp
@endif

<button type="{{ $type }}" title="{{ $title }}" id="{{ $id }}"
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>
