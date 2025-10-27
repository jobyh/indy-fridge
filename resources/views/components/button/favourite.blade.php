@props(['icon' => null])
<x-button {{ $attributes }}>
    <x-icon.heart {{ $icon?->attributes }} class="w-4 h-4 transition-colors text-gray-400" />
    <span>{{ $slot }}</span>
</x-button>
