@props(['active' => false])
@php
    $classes = $active ? 'underline' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} aria-current="{{ request()->is($active) ? 'page' : 'false' }}">{{ $slot }}</a>