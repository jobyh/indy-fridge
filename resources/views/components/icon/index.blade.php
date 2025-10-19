@props(['width' => 512, 'height' => 512])
<svg aria-hidden="true" {{ $attributes->class('fill-current') }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {{ $width }} {{ $height }}">{{ $slot }}</svg>
