<aside {{ $attributes->class('scroll overflow-y-scroll px-layout py-4 border-r border-default') }}>
    <x-search.refinement-list facet="brewery" label="Brewery" />
    <x-search.refinement-list facet="style" label="Style" class="mt-6" />
    <x-search.refinement-list facet="hops" label="Hops" class="mt-6" />
</aside>
