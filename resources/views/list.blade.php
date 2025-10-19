@use(App\Models\Beer)
@use(Illuminate\Support\Facades\Route)
@php
    $session = Beer::orderBy('abv')->where('abv', '>', 4)->where('abv', '<', 5)->get();
    $pale = Beer::orderBy('abv')->where('abv', '>=', 5)->where('abv', '<', 7.4)->get();
    $strong = Beer::orderBy('abv')->where('abv', '>=', 7.5)->get();
@endphp
<x-layout.html>
    <x-slot:head>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,800" rel="stylesheet" />
        <style>
            html {
                font-family: 'Instrument Sans', sans-serif;
                font-size: 16px;
            }

            body {
                padding: 2rem 3rem;
            }

            * {
                font-size: 1rem;
                font-weight: 400;
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            h1,
            h2 {
                width: 100%;
                text-align: center;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-weight: bold;
            }

            h1 {
                font-size: 1.15rem;
                margin-bottom: .25rem;
            }

            h2 {
                font-size: 1.05rem;
                padding: 0.25rem 0;
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                margin-bottom: .15rem;
            }

            .drink-in {
                width: 100%;
                text-align: center;
                font-weight: bold;
                font-size: 1.05rem;
                margin-bottom: .25rem;
            }

            .section-end {
                margin-bottom: 1rem;
            }

            .clearfix {
                clear: both;
            }

            .list__item {
                width: 49%;
                display: inline-block;
            }


            .list__item__brewery,
            .list__item__name,
            .list__item__style,
            .list__item__abv,
            .list__item__size,
            .list__item__price {
                white-space: nowrap;
                font-size: 0.85rem;
            }

            .list__item--partner {
                margin-left: 1%;
            }

            /*.list__item {*/
            /*    display: flex;*/
            /*    white-space: nowrap;*/
            /*    justify-content: space-between;*/
            /*    align-items: center;*/
            /*}*/

            /*.list__item__name {*/
            /*    overflow: hidden;*/
            /*    text-overflow: ellipsis;*/
            /*    white-space: nowrap;*/
            /*    flex-shrink: 1;*/
            /*}*/

            .list__item__style,
            .list__item__price {
                font-weight: bold;
            }
        </style>
    </x-slot:head>

    <h1>Take-out cans (44cl unless stated)</h1>

    <x-list.section :beers="$session" heading="Session Pales (up to 4.9%)" />
    <x-list.section :beers="$pale" heading="Pale / IPA (5%-7.4%)" />
    <x-list.section :beers="$strong" heading="Double / Triple (Over 7.5%)" />

</x-layout.html>
