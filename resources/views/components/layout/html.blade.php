@use(Illuminate\Support\Facades\Vite)
<!DOCTYPE html>
<html {{ $attributes->merge(['lang' => str_replace('_', '-', app()->getLocale())])->class('text-lg lg:text-xl min-h-dvh') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Indy Fridge</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/graphics/favicon.png') }}" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @if (config('services.fathom.site_id'))
        <script src="https://cdn.usefathom.com/script.js" data-site="{{ config('services.fathom.site_id') }}" defer></script>
    @endif

    {{ $head ?? '' }}
</head>
<body class="antialiased font-sans text-white h-full overflow-y-scroll">
    {{ $slot }}
</body>
</html>
