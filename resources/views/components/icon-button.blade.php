@props(['icon', 'label'])
<button {{ $attributes->class('border border-default p-1.5 rounded shadow-md') }}>
    <span class="sr-only">{{ $label }}</span>
    <x-dynamic-component component="icon.{{ $icon }}" class="w-6 h-6" />
</button>
