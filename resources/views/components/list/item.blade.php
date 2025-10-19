@props(['beer'])
@use(Illuminate\Support\Str)
@php
    $raw = "$beer->brewery - $beer->name $beer->style $beer->abv%"
@endphp
<div {{ $attributes->class('list__item') }}>
    <span class="list__item__brewery">{{ $beer->brewery }} -</span>
    <span class="list__item__name">{{ Str::limit($beer->name, 10) }}</span>
    <span class="list__item__style">{{ Str::limit($beer->style, 10) }}</span>
    <span class="list__item__abv">{{ $beer->abv }}%</span>
    <span class="list__item__price">{{ $beer->price_for_humans }}</span>
    @if ($beer->size !== '44cl')
        <span class="list__item__size">{{ $beer->size }}</span>
    @endif
</div>
