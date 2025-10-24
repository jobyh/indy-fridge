@use(Illuminate\Support\Carbon)
@use(App\Models\Settings\BuildSetting)
<div {{ $attributes->class("my-3 flex items-center justify-between flex-wrap") }}>
    <x-search.hits-count />
    <p class="text-sm text-white hidden sm:block">{{ BuildSetting::sole()->forHumans() }}</p>
</div>
