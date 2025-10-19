<div {{ $attributes->whereDoesntStartWith('x-')->class('inline-flex items-end') }}>
    <x-type {{ $attributes->whereStartsWith('x-') }}></x-type>
    <span class="ml-0.5">%</span>
    <x-type class="text-[11px] -translate-[1px] ml-1.5 tracking-wide">ABV</x-type>
</div>
