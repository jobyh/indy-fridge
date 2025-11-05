@props(['activeExpression', 'activeLabel', 'inactiveLabel'])
<x-button.icon-button
    {{ $attributes }}
    x-bind:class="{ '!bg-radial !from-pink-300 !to-pink-500': ({!! $activeExpression !!}) }"
>
    <x-icon.heart
        class="w-4 h-4 transition-colors"
        x-bind:class="{ 'text-pink-100' : ({!! $activeExpression !!}), 'text-gray-400': !({!! $activeExpression !!}) }"
    />
    <x-slot:label x-text="({!! $activeExpression !!}) ? '{{ $activeLabel }}' : '{{ $inactiveLabel }}'">
        {{ $inactiveLabel }}
    </x-slot:label>
    {{ $slot }}
</x-button.icon-button>
