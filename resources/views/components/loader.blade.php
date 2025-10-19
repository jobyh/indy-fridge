<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('loader', () => ({
            show: true,
            init() {
                window.addEventListener('searchHitsUpdated', event => {
                    this.show = false
                })
            },
        }))
    })
</script>
<div x-data="loader" x-show="show" class="w-full flex flex-col items-center justify-center animate-pulse opacity-90">
    <x-icon.downloading class="w-28 mt-20" />
    <span class="uppercase text-lg tracking-wide">Loading</span>
</div>
