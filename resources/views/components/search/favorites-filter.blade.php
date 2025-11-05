<script>
    window.addEventListener('alpine:init', () => {

        Alpine.store('favorites', {
            active: false,
            items: Alpine.$persist([]).as('beer-favorites'),
            init() {
                Alpine.effect(() => this.active ? this.applyFilter() : this.clearFilter())
            },
            applyFilter() {
                this.items.forEach(url => {
                    window.dispatchEvent(new CustomEvent('urlFacetToggle', {
                        detail: { value: url }
                    }))
                })
            },
            clearFilter() {
                window.dispatchEvent(new CustomEvent('clearRefinements', {
                    detail: { refinements: ['url'] }
                }))
            },
            toggleFavorite(url) {
                this.has(url) ? this.remove(url) : this.add(url)
            },
            toggleActive() {
                this.active = !this.active
            },
            get count() {
                return this.items.length
            },
            get hasFavorites() {
                return this.count > 0
            },
            add(url) {
                if (!this.items.includes(url)) {
                    this.items.push(url)
                    this.notifyChange()
                }
            },

            remove(url) {
                this.items = this.items.filter(item => item !== url)
                this.notifyChange()
            },

            has(url) {
                return this.items.includes(url)
            },
            notifyChange() {
                if (this.hasFavorites === false && this.active) {
                    this.active = false
                } else if (this.active) {
                    this.clearFilter()
                }
            }
        })
    })
</script>
<x-button.favourite
    variant="light"
    x-data
    x-on:click="$store.favorites.toggleActive()"
    x-bind:disabled="!$store.favorites.hasFavorites"
    active-expression="$store.favorites.active"
    active-label="Show all beers"
    inactive-label="Show favourites only"
    class="relative"
>
    <span
        x-cloak
        x-show="$store.favorites.hasFavorites"
        x-text="$store.favorites.count"
        @class([
            'absolute right-0 top-0',
            'bg-white text-black text-xs',
            'px-1.5 rounded-full',
            'translate-x-1/3 -translate-y-1/3'
        ])
    ></span>
</x-button.favourite>
