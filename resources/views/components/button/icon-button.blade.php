@props(['icon' => null, 'label'])
<x-button {{ $attributes }}>
    <span class="sr-only">{{ $label }}</span>
    @if (is_string($icon))
        <x-dynamic-component component="icon.{{ $icon }}" class="w-4 h-4" />
    @else
        {{ $slot }}
    @endif
</x-button>
