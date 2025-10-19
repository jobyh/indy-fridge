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
        'flex gap-2 items-stretch rounded-sm',
        'border border-white/15',
        'bg-white/10 overflow-hidden',
    ]) }}
>
    <label for="search" class="sr-only">Search beers</label>
    <input
        id="search"
        x-model.debounce="query"
        name="search"
        type="text"
        placeholder="Search"
        class="px-3 w-full outline-none"
        autocomplete="off"
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

</div>
