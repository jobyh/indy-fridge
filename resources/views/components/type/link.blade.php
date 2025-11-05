@props(['variant' => ''])
@use(Illuminate\Support\Str)
<x-type {{ $attributes->merge(['tag' => 'a'])->class([
    'text-white' => Str::doesntContain($variant, 'dark'),
    'text-gray-900' => Str::contains($variant, 'dark'),
    'underline underline-offset-2 decoration-1 decoration-green-500',
    'outline-none focus-visible:bg-blue-500 focus-visible:text-black',
    'focus-visible:decoration-black',
    'px-0.5 py-1',
]) }}>{{ $slot }}</x-type>
