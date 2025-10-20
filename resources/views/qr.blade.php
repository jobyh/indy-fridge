@use(chillerlan\QRCode\Common\EccLevel)
@use(chillerlan\QRCode\QRCode)
@use(chillerlan\QRCode\QROptions)

@php
    $url = 'https://indy-fridge.jobyharding.com';
    $options = new QROptions([
        'addLogoSpace' => true,
        'logoSpaceWidth' => 15,
        'logoSpaceHeight' => 15,
        'eccLevel' => EccLevel::H,
    ]);
@endphp

<x-layout.html>

    <div class="relative w-sm h-sm border-black">
        <img
            alt="QR Code link to {{ $url }}"
            src="{{ new QRCode($options)->render($url) }}"
            class="w-full h-full"
        />
        <x-icon.crow @class([
            'text-black absolute top-1/2 left-1/2',
            '-translate-x-1/2 -translate-y-[calc(50%+0.5rem)]',
            'w-28 h-28'
        ]) />
        <p class="absolute font-mono text-xs text-black top-2 left-8">{{ $url }}</p>
    </div>
</x-layout.html>
