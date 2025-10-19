<script>
    window.addEventListener('alpine:init', () => {
        Alpine.data('breweryFacets', () => ({
            items: [],
            refine: null,
            init() {
                window.addEventListener('breweryFacetsUpdated', (event) => {
                    this.items = event.detail.items.sort((a, b) => a.label.localeCompare(b.label));
                    this.refine = event.detail.refine;
                })
            },
            toggle(value) {
                if (this.refine) {
                    this.refine(value);
                }
            },
            reset() {
                this.$dispatch('clearRefinements', ['brewery'])
            },
            get hasRefinements() {
                return this.items.some(item => item.isRefined)
            }
        }))
    })
</script>
<div x-data="breweryFacets">
    <div class="flex items-center justify-between mb-2">
        <x-type tag="legend" variant="upper" class="text-sm">Brewery</x-type>
        <button
            x-show="hasRefinements"
            @click="reset"
            class="text-xs text-gray-500 hover:text-gray-300 cursor-pointer"
        >
            Reset
        </button>
    </div>
    <ul class="space-y-1.5">
        <template x-for="item in items" :key="item.value">
            <li>
                <label @class([
                    'flex items-center gap-2 cursor-pointer px-3 py-1',
                    'bg-gray-900 hover:bg-gray-200 hover:bg-gray-800 rounded',
                    'has-checked:bg-gray-700 has-checked:text-white'
                ])>
                    <input
                        type="checkbox"
                        :checked="item.isRefined"
                        x-on:change="toggle(item.value)"
                        class="rounded border-gray-700"
                    />
                    <span class="text-sm" x-text="item.label"></span>
                    <span class="text-sm text-gray-400">
                        (<span x-text="item.count"></span>)
                    </span>
                </label>
            </li>
        </template>
    </ul>
</div>
