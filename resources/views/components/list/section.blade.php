@props(['beers', 'heading'])
@use(App\Models\Beer)
@use(Illuminate\Support\Collection)

<h2>{!! $heading !!}</h2>
<p class="drink-in">Drink in for £1 extra</p>

@php
    /**
     * @var Collection<Beer> $beers
     */
    $chunks = $beers->chunk(ceil($beers->count() / 2));;
@endphp
@foreach($chunks->first() as $i => $beer)
    @php
        $partner = $chunks->get(1)?->values()->get($i);
    @endphp
    <x-list.item :beer="$beer" />
    @if ($partner)
        <x-list.item :beer="$partner" class="list__item--partner" />
    @endif
    <div class="clearfix"></div>
@endforeach
<div class="section-end"></div>
