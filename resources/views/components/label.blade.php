@props(['variant' => ''])
@php
    $px = 'px-2';
    $py = 'py-1';
    $divide = 'divide-x divide-gray-600';
    $wantsDivide = str_contains($variant, 'divide');
@endphp
<div {{ $attributes->class([
    'bg-black/30',
    'ring-white/20 ring-1',
    'rounded-sm text-white text-[0.7rem]',
    'tracking-wider',
    $divide,
]) }}>
    @if (isset($pre) && $pre->hasActualContent())
        <div @class([$px, $py])">{{ $pre }}</div>
    @endif
    <div @class([$px => !$wantsDivide, $py => !$wantsDivide, $divide => $wantsDivide])>{{ $slot }}</div>
</div>
