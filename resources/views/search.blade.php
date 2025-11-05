<x-layout.html class="bg-gradient-to-b from-blue-700 to-green-500 h-screen overflow-hidden">
    <x-slot:head>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </x-slot:head>
    <x-layout.header class="sticky top-0 z-10" />
    <main class="w-layout mx-auto px-layout">
        <x-search.info x-cloak x-data class="mx-layout"  />
        <x-search.hits x-cloak class="-mx-layout md:!mx-0" />
        <x-loader x-data="loader" />
    </main>
    <x-disclaimer />
</x-layout.html>
