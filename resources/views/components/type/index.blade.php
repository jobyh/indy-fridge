@props(['tag' => 'span', 'variant' => ''])
@use(function App\variants)
@php
    $classes = variants([
        'upper' => 'uppercase tracking-wider',
        'bold' => 'font-bold',
        'bright' => 'text-white',
        'dim' => 'text-gray-300',
    ], $variant);
@endphp
<{{ $tag }} {{ $attributes->class($classes) }}>{{ $slot }}</{{ $tag }}>
