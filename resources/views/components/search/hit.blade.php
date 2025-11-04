@props(['tag' => 'div'])
<{{ $tag }} {{ $attributes->class('px-layout py-4 relative bg-gray-900 rounded-2xl shadow-xl grid grid-cols-12 gap-4') }}>
    <div class="hidden sm:flex bg-white w-full h-full aspect-square rounded-md col-span-3 items-center justify-center py-3">
        <img x-bind:src="hit.product_image" x-bind:alt="'Picture of ' + hit.name" class="object-cover w-full h-full text-xs text-gray-500" />
    </div>

    <div class="col-span-12 sm:col-span-9">
        <div class="flex flex-row items-center flex-wrap gap-x-4 gap-y-2">
            <x-label>
                <div class="flex items-center gap-1.5">
                    <x-icon.brewery class="w-4 h-4 text-gray-400" />
                    <span class="sr-only">Brewery: </span>
                    <x-type x-text="hit.brewery" variant="upper" class="translate-y-[0.05rem] pr-0.5"></x-type>
                </div>
            </x-label>

            <div x-show="hit.hops.length">
                <div class="!text-sm flex items-center flex-wrap">
                    <span class="sr-only">Hops: </span>
                    <x-icon.hop class="w-4 h-4 text-gray-500 mr-1.5" />
                    <x-type tag="ul" variant="dim" class="flex items-center gap-1.5 flex-wrap">
                        <template x-for="(hop, index) in hit.hops" :key="hop">
                            <x-type x-tag="li" class="inline-block">
                                <span x-text="hop"></span><span x-show="index < hit.hops.length - 1">, </span>
                            </x-type>
                        </template>
                    </x-type>
                </div>
            </div>

        </div>

        <x-type tag="h2" variant="bright bold" class="mt-2 leading-tight flex flex-col">
            <x-type x-html="hit.name" class="text-lg "></x-type>
        </x-type>
        <x-search.style-and-tags class="text-gray-300" />

        <x-abv x-html="hit.abv" />

        <x-type variant="dim" tag="p" x-html="hit.description" class="text-sm mt-1.5 max-w-3xl"></x-type>

        <dl class="mt-3 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
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

            <div class="inline-flex items-stretch gap-2">

                <x-button.icon-button
                    class="order-last"
                    x-on:click="$store.favorites.toggle(hit.url)"
                    x-bind:class="{ '!bg-pink-500/20': $store.favorites.has(hit.url) }"
                >
                    <x-icon.heart
                        class="w-4 h-4"
                        x-bind:class="$store.favorites.has(hit.url) ? 'text-pink-400' : 'text-gray-400'"
                    />
                    <x-slot:label x-text="$store.favorites.has(hit.url) ? 'Remove from favourites' : 'Add to favourites'"
                    >
                        Add to favourites
                    </x-slot:label>
                </x-button.icon-button>

                <div class="grow">
                    <dt class="sr-only">Quantity in stock</dt>
                    <dd>
                        <x-button variant="primary" href="#" x-bind:href="'https://theindependent.pub' + hit.url" class="w-full sm:w-32">
                            <x-type x-text="hit.stock"></x-type><span aria-hidden="true"> in stock</span>
                        </x-button>
                    </dd>
                </div>

            </div>
        </dl>
    </div>
</{{ $tag }}>
