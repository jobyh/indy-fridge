<script>
    window.addEventListener('alpine:init', () => {
        Alpine.data('hits', () => ({
            totalHits: undefined,
            hits: [],
            isLastPage: true,
            showMore: null,
            isLoadingMore: false,
            init() {
                window.addEventListener('searchHitsUpdated', (event) => {
                    this.handleHitsUpdated(event)
                })
            },
            highlight(hit, field) {
                return hit._highlightResult && hit._highlightResult[field]
                    ? hit._highlightResult[field].value
                    : hit[field];
            },
            mapHits(hits) {
                return hits.map(hit => {
                    const properties = [
                        'url', 'name', 'brewery', 'style',
                        'abv', 'description', 'modifiedAt',
                        'hops', 'size', 'price_for_humans',
                        'stock', 'tags', 'product_image',
                    ]

                    return properties.reduce((acc, prop) => {
                        const highlight = ['name', 'description', 'style']
                        acc[prop] = highlight.includes(prop) ? this.highlight(hit, prop) : hit[prop]
                        return acc
                    }, {})
                })
            },
            handleHitsUpdated(event) {
                this.hits = this.mapHits(event.detail.hits);
                this.totalHits = event.detail.totalHits;
                this.isLastPage = event.detail.isLastPage;
                this.showMore = event.detail.showMore;

                this.$nextTick(() => {
                    window.dispatchEvent(new CustomEvent('hitsRendered'));
                })
            },
            handleMoreClick() {
                window.Nprogress.start()
                this.showMore()
            }
        }))
    })
</script>
<div
    {{ $attributes->class(['search-hits']) }}
    x-data="hits"
>

    <div x-show="hits.length > 0">
        <ul class="space-y-3">
            <template x-for="hit in hits" :key="hit.url">
                <x-search.hit tag="li" />
            </template>
        </ul>
    </div>

    <div class="px-layout flex justify-center py-8">
        <button x-show="!isLastPage" x-on:click="handleMoreClick" class="active:scale-95 cursor-pointer px-6 py-2 bg-gray-800 border border-default rounded-sm">
            <x-type variant="upper" class="text-sm">Show more</x-type>
        </button>
    </div>
</div>
