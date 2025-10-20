<x-type {{ $attributes->merge(['tag' => 'a'])->class([
    'underline underline-offset-2 decoration-1 decoration-green-500 text-white',
    'outline-none focus-visible:bg-blue-500 focus-visible:text-black',
    'focus-visible:decoration-black',
    'px-0.5 py-1',
]) }}>{{ $slot }}</x-type>
