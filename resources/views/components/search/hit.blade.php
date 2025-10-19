@props(['tag' => 'div'])
<{{ $tag }} {{ $attributes->class('px-layout py-4 relative bg-gray-900 rounded-2xl shadow-xl') }}>
    <div class="flex items-center flex-wrap gap-x-4 gap-y-2">
        <x-label>
            <div class="flex items-center gap-1.5">
                <x-icon.brewery class="w-4 h-4 text-gray-400" />
                <span class="sr-only">Brewery: </span>
                <x-type x-text="hit.brewery" variant="upper" class="translate-y-[0.05rem] pr-0.5"></x-type>
            </div>
        </x-label>

        <x-label x-show="hit.hops.length">
            <div class="flex items-center flex-wrap">
                <span class="sr-only">Hops: </span>
                <x-icon.hop class="w-4 h-4 text-gray-400 mr-1.5" />
                <ul class="flex items-center gap-1.5 flex-wrap">
                    <template x-for="(hop, index) in hit.hops" :key="hop">
                        <x-type x-tag="li" variant="upper" class="inline-block">
                            <span x-text="hop"></span><span x-show="index < hit.hops.length - 1">, </span>
                        </x-type>
                    </template>
                </ul>
            </div>
        </x-label>
    </div>

    <x-type tag="h2" variant="bright bold" class="mt-2 leading-tight flex flex-col">
        <x-type x-html="hit.name" class="text-lg "></x-type>
        <div class="text-sm">
            <x-type x-html="hit.style"></x-type>
            <x-abv x-html="hit.abv" />
        </div>
    </x-type>
    <x-type variant="dim" tag="p" x-html="hit.description" class="text-sm mt-1.5 max-w-3xl"></x-type>
    <dl class="mt-3">
        <div class="flex items-end gap-2">
            <dt class="sr-only">Price</dt>
            <dd>
                <x-type variant="bright bold" x-html="hit.price_for_humans" class="leading-3"></x-type>
            </dd>
            <dt class="sr-only">Volume</dt>
            <dd>
                <x-type variant="bright bold" x-html="hit.size" class="text-xs leading-2"></x-type>
            </dd>
        </div>
        <dt class="sr-only">Quantity in stock</dt>
        <dd class="text-sm">
            <x-type x-text="hit.stock"></x-type><span aria-hidden="true"> in stock</span>
        </dd>
    </dl>
</{{ $tag }}>
