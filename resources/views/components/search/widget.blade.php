<script>
    window.addEventListener('alpine:init', () => {
        Alpine.data('search', () => ({
            loaded: false,
            query: '',
            init() {
                this.$watch('query', value => {
                    this.$dispatch('searchInput', { value });
                })
                this.$refs.button.classList.remove('opacity-20')

                window.addEventListener('filterByFavorites', () => {
                    this.clear()
                })
            },
            clear() {
                this.query = ''
            },
            disableClear() {
                return this.query === ''
            }
        }));
    })
</script>
<div
    x-data="search"
    {{ $attributes->class([
        'relative',
        'flex gap-2 items-stretch rounded-sm',
        'bg-gray-700 overflow-hidden',
        'focus-within:ring-3 focus-within:ring-green-500'
    ]) }}
>
    <label for="search" class="sr-only">Search beers</label>
    <input
        id="search"
        x-model.debounce.400ms="query"
        name="search"
        type="text"
        placeholder="{{ Arr::random([
          'Peacharine nectaron',
          'Beak IPA',
          'Rivington',
          'Arpus',
          'Pressure Drop',
          'Mosaic citra',
          'DDH NEIPA',
        ]) . '...' }}"
        class="placeholder:text-gray-400 pl-8 pr-3 w-full outline-none"
        autocomplete="off"
        spellcheck="false"
        x-on:keydown.escape="clear"
    />
    <button
        x-ref="button"
        x-on:click="clear"
        x-bind:disabled="disableClear"
        @class([
            'text-gray-300 p-2 focus:outline-none',
            'focus-visible:bg-white focus-visible:text-black',
            'disabled:opacity-20 opacity-20',
        ])
    >
        <x-icon.xmark class="w-4 h-4 " />
        <span class="sr-only">Clear</span>
    </button>

    <div class="absolute top-0 left-0 h-full flex items-center justify-center px-2">
        <x-icon.search class="w-4 h-4 text-gray-400" />
    </div>
</div>
