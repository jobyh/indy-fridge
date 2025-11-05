@props(['variant' => ''])
@use(Illuminate\Support\Collection)
@php
    $tag = $attributes->has('href') ? 'a' : 'button';
    $variants = Collection::make(explode(' ', $variant))
        ->map(fn ( string $str) => trim($str));
@endphp
<{{ $tag }} {{ $attributes->class([
    'inline-block',
    'rounded-md font-medium text-center',
    'active:scale-95 cursor-pointer',
    'bg-radial from-blue-300 to-blue-500 text-gray-900' => $variants->contains('primary'),
    'bg-white/60 text-gray-900' => $variants->contains('light'),
    'bg-gray-900/60 ring-1 ring-white/20' => $variants->doesntContain('primary') && $variants->doesntContain('light'),
    'px-5 py-1.5 ring-1 ring-black/20' => $variants->doesntContain('no-padding'),
    'focus:outline-none focus-visible:ring-3 focus-visible:ring-white',
    'disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100',
]) }}>{{ $slot }}</{{ $tag }}>
