@use(Illuminate\Support\Carbon)
<div {{ $attributes->class("my-3 flex items-center justify-between flex-wrap") }}>
    <x-search.hits-count />
    {{-- Time now as is a static build. --}}
    <p class="text-sm text-white hidden sm:block">Updated {{ Carbon::now()->timezone('Europe/London')->format('D M jS  H:i') }}</p>
</div>
