@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
    $base = 'books-btn';
    $sizes = [
        'sm' => 'books-btn-sm',
        'md' => 'books-btn-md',
    ];
    $variants = [
        'primary' => 'books-btn-primary',
        'warning' => 'books-btn-warning',
        'danger' => 'books-btn-danger',
        'muted' => 'books-btn-muted',
        'outline' => 'books-btn-outline',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $classes = trim($base.' '.$sizeClass.' '.$variantClass);

    if ($disabled) {
        $classes .= ' is-disabled';
    }
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if ($disabled) aria-disabled="true" tabindex="-1" @endif
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @if ($disabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif
