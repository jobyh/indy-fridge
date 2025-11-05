<div {{ $attributes->class([
    'bg-gray-900 py-3 border-default border-b',
]) }}>
    <div class="w-layout mx-auto px-layout">
        <div class="mx-layout md:mx-0">
            <div class="text-xs flex justify-between items-center -translate-y-1">
                <div class="items-center gap-1 text-nowrap hidden md:flex">
                    <x-type tag="h1" class="uppercase tracking-wider flex items-center gap-1.5">
                        <x-icon.crow class="w-4 h-4 -translate-y-0.5" />
                        {{ config('app.name') }}
                    </x-type>
                </div>
            </div>

            <div class="flex w-full items-stretch gap-2">
                <x-search.widget class="flex-grow" />
                <span class="hidden md:flex items-center ml-6 mr-2 text-sm">Sort by</span>

                <x-search.sort-order class="md:w-[12rem]" />
                <x-search.favorites-filter class="h-full" />
            </div>

        </div>
    </div>
</div>
