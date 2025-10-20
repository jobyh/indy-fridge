@props(['variant' => ''])
@php
    $options = [
        (object)[
            'value' => 'beers-modified-desc',
            'label' => 'Updated',
            'icon' => 'sort-desc',
        ],
        (object)[
            'value' => 'beers-price-asc',
            'label' => 'Price Low',
            'icon' => 'sort-asc',
        ],
        (object)[
            'value' => 'beers-price-desc',
            'label' => 'Price High',
            'icon' => 'sort-desc',
        ],
        (object)[
            'value' => 'beers-abv-asc',
            'label' => 'ABV low',
            'icon' => 'sort-asc',
        ],
        (object)[
            'value' => 'beers-abv-desc',
            'label' => 'ABV high',
            'icon' => 'sort-desc',
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
            get currentOption() {
                return this.options.find(option => option.value === this.index)
            },
            get optionIcon() {
                return this.currentOption.icon;
            },
            get optionLabel() {
                return this.currentOption.label;
            },
        }))
    })
</script>
<div {{ $attributes->class('group flex items-stretch gap-1.5 bg-[lime') }}>
    <div
        x-data="sortBy"
        @class([
            'group w-full',
            'relative overflow-hidden',
            'border-white/20 border',
            'rounded-sm',
            'group-has-focus-visible:ring-2 group-has-focus-visible:ring-blue-500',
        ])
    >
        <x-form.select
            {{ $attributes->only('id') }}
            x-model="index"
            :options="$options"
            name="sort-by"
            @class([
                'absolute top-0 right-0 bottom-0 left-0 opacity-0',
            ])
        />
        <div
            @class([
                'px-2 py-1',
                'flex h-full items-center gap-1.5 justify-start bg-white/10 pointer-events-none',
            ])
        >
            <div>
                @foreach(collect($options)->pluck('icon')->unique() as $icon)
                    <x-dynamic-component
                        x-show="optionIcon === '{{ $icon }}'"
                        component="icon.{{ $icon }}"
                        class="w-4 h-4 text-gray-400"
                    />
                @endforeach
            </div>
            <x-type x-cloak aria-hidden="true" x-text="optionLabel" class="hidden sm:block grow text-sm">{{ $options[0]->label }}</x-type>
            <x-icon.select-handle class="w-3 h-3 text-gray-400" />
        </div>
    </div>
</div>
