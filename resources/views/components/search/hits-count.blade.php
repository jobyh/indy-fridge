<script>
    window.addEventListener('alpine:init', () => {
        Alpine.data('hitsCount', () => ({
            showing: 0,
            totalHits: undefined,
            handleHitsUpdated(event) {
                this.showing = event.detail.hits.length
                this.totalHits = event.detail.totalHits
            },
            hasHits() {
                return typeof totalHits === 'undefined' || totalHits === 0
            },
            noHits() {
                return !this.hasHits()
            },
            moreHits() {
                return this.showing < this.totalHits
            },
            get beerOrBeers() {
                return this.totalHits === 1 ? 'beer' : 'beers'
            }
        }))
    })
</script>
<p
    {{ $attributes->class([
        'text-white text-sm',
    ]) }}
    x-data="hitsCount"
    x-on:search-hits-updated.window.camel="handleHitsUpdated"
>
    <span x-show="noHits">No beers found</span>
    <span x-show="hasHits">
        <span x-text="totalHits" class="bg-white text-black px-2 py-0.5 rounded-full font-bold inline-block mr-0.5"></span>
        <span x-text="beerOrBeers"></span>
    found</span>
    <span x-show="moreHits">(showing <span x-text="showing"></span>)</span>
</p>
