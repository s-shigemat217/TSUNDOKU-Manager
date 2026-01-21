@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center rounded-md font-semibold no-underline select-none transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';
    $sizes = [
        'sm' => 'px-4 py-2.5 text-sm',
        'md' => 'px-5 py-3 text-base',
    ];
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus-visible:ring-blue-300',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus-visible:ring-yellow-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-300',
        'muted' => 'bg-slate-200 text-slate-500 cursor-not-allowed',
        'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-50 focus-visible:ring-gray-300',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $classes = trim($base . ' ' . $sizeClass . ' ' . $variantClass);

    if ($disabled) {
        $classes .= ' opacity-60 pointer-events-none';
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
