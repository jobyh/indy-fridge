<div {{ $attributes->class([
    'bg-gray-900/60 py-3 ring-white/20 ring-1',
    'backdrop-blur-lg'
]) }}>
    <div class="w-layout mx-auto px-layout">
        <div class="mx-layout md:mx-0">
            <div class="text-xs flex justify-between items-center -translate-y-1">
                <div class="items-center gap-1 text-nowrap hidden md:flex">
                    <x-type tag="h1" class="text-[11px] uppercase tracking-wider flex items-center gap-1">
                        <x-icon.crow class="w-3 h-3 -translate-y-0.5" />
                        Indy Fridge
                    </x-type>
                </div>
            </div>

            <div class="flex w-full items-stretch gap-2">
                <x-search.widget class="flex-grow" />
                <span class="hidden md:flex items-center ml-6 mr-1 text-sm whitespace-nowrap">Sort by</span>

                <x-search.sort-order class="md:w-[12rem]" />
                <x-search.favorites-filter class="h-full" />
            </div>

        </div>
    </div>
</div>
