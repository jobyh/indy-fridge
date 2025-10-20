@props(['variant' => ''])
@php
    $options = [
        (object)[
            'value' => 'beers-modified-desc',
            'label' => 'Updated',
        ],
        (object)[
            'value' => 'beers-price-asc',
            'label' => 'Price Low',
        ],
        (object)[
            'value' => 'beers-price-desc',
            'label' => 'Price High',
        ],
        (object)[
            'value' => 'beers-abv-asc',
            'label' => 'ABV low',
        ],
        (object)[
            'value' => 'beers-abv-desc',
            'label' => 'ABV high',
        ],
    ];
@endphp
<script>
    window.addEventListener('alpine:init', () => {
        Alpine.data('sortBy', () => ({
            index: '{{ $options[0]->value }}',
            options: @json($options),
            init() {
                this.$watch('index', () => {
                    this.$dispatch('sortChanged', { index: this.index })
                })
            },
            optionLabel() {
                return this.options.find(option => option.value === this.index).label;
            },
        }))
    })
</script>
<div {{ $attributes->class('flex items-stretch gap-1.5 bg-[lime') }}>
    <div
        x-data="sortBy"
        @class([
            'w-full',
            'relative overflow-hidden',
            'border-white/20 border',
            'rounded-sm',
        ])
    >
        <x-form.select
            {{ $attributes->only('id') }}
            x-model="index"
            :options="$options"
            name="sort-by"
            @class(['absolute top-0 right-0 bottom-0 left-0 opacity-0'])
        />
        <div
            @class([
                'px-2 py-1',
                'flex h-full items-center gap-1.5 justify-start bg-white/10 pointer-events-none',
            ])
        >
            <x-icon.sort class="w-5 h-5 text-gray-400 translate-y-[2px]" />
            <x-type aria-hidden="true" x-text="optionLabel" class="hidden sm:block grow text-sm">{{ $options[0]->label }}</x-type>
            <x-icon.select-handle class="w-3 h-3 text-gray-400" />
        </div>
    </div>
</div>
