<script>
    window.addEventListener('alpine:init', () => {
        function notifyChange(items) {
            window.dispatchEvent(
                new CustomEvent('favoritesChanged', {
                    detail: { items },
                }),
            )
        }

        Alpine.store('favorites', {
            items: Alpine.$persist([]).as('beer-favorites'),

            add(url) {
                if (!this.items.includes(url)) {
                    this.items.push(url)
                    notifyChange(this.items)
                }
            },

            remove(url) {
                this.items = this.items.filter(item => item !== url)
                notifyChange(this.items)
            },

            toggle(url) {
                if (this.has(url)) {
                    this.remove(url)
                } else {
                    this.add(url)
                }
            },

            has(url) {
                return this.items.includes(url)
            },

            count() {
                return this.items.length
            },

            clear() {
                this.items = []
                notifyChange(this.items)
            },
        })

        Alpine.data('favoritesFilter', () => ({
            active: false,
            init() {
                this.$watch('active', () => {
                    if (this.active) {
                        this.applyFilter()
                    } else {
                        this.clearFilter()
                    }
                })

                window.addEventListener('favoritesChanged', () => {
                    if (this.hasFavorites === false && this.active) {
                        this.active = false
                    } else if (this.active) {
                        this.clearFilter()
                        this.$nextTick(() => {
                            this.applyFilter()
                        })
                    }
                })
            },
            get hasFavorites() {
                return this.$store.favorites.count() > 0
            },
            applyFilter() {
                this.$store.favorites.items.forEach(url => {
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
            toggle() {
                this.active = !this.active
            }
        }))
    })
</script>
<x-button.icon-button
    x-data="favoritesFilter"
    x-on:click="toggle()"
    x-bind:disabled="!hasFavorites"
    x-bind:class="{ 'bg-pink-500/20' : active }"
>
    <x-icon.heart
        class="w-4 h-4 transition-colors"
        x-bind:class="{ 'text-pink-400 fill-pink-400' : active, 'text-gray-400': !active }"
    />
    <x-slot:label x-text="active ? 'Show all beers' : 'Show favourites only'">
        Show favourites only
    </x-slot:label>
</x-button.icon-button>
