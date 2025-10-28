@props(['variant' => ''])
@use(Illuminate\Support\Collection)
@php
    $tag = $attributes->has('href') ? 'a' : 'button';
    $variants = Collection::make(explode(' ', $variant))
        ->map(fn ( string $str) => trim($str));
@endphp
<{{ $tag }} {{ $attributes->class([
    'inline-block',
    'rounded-md font-bold text-center',
    'active:scale-95 cursor-pointer',
    'bg-blue-500 text-gray-900' => $variants->contains('primary'),
    'bg-gray-700' => $variants->doesntContain('primary'),
    'px-5 py-1.5' => $variants->doesntContain('no-padding'),
    'focus:outline-none focus-visible:ring-3 focus-visible:ring-green-500',
    'disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100',
]) }}>{{ $slot }}</{{ $tag }}>
