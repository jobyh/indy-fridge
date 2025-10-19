<div {{ $attributes->class([
    'bg-black/75 backdrop-blur-lg saturate-40 py-3 border-default border-b',
]) }}>
    <div class="w-layout mx-auto px-layout">

        <div class="text-xs flex justify-between items-center -translate-y-1">
            <div class="flex items-center gap-2 text-nowrap">
                <x-type tag="h1" class="uppercase tracking-wider flex items-center gap-1.5">
                    <x-icon.crow class="w-4 h-4 -translate-y-0.5" />
                    {{ config('app.name') }}
                </x-type>
                <p class="text-[10px] sm:text-xs">by <a href="https://fullstackappco.com" class="underline decoration-[lime]">Joby</a></p>
            </div>
            <small class="text-[10px] sm:text-xs text-nowrap">Search <span class="hidden sm:inline">powered</span> by <a href="https://algolia.com" class="underline decoration-[lime]">Algolia</a></small>
        </div>

        <div class="flex w-full items-stretch gap-2">
            <x-search.widget class="flex-grow" />
            <span class="hidden md:flex items-center ml-6 mr-2 text-sm">Sort by</span>

            <x-search.sort-order class="md:w-[12rem]" />
        </div>

    </div>
</div>
