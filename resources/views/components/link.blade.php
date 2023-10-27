@props(['route', 'title'])

<a href="{{ $route }}" title="{{ $title }}">
    {{ $slot }}
</a>
