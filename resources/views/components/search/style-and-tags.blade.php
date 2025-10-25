<div {{ $attributes->class('flex items-center gap-1.5') }}>
    <x-type x-html="hit.style + (hit.tags.length ? ', ': '')"></x-type>
    <span x-show="hit.tags.length > 0" class="flex items-center gap-1.5 flex-wrap">
        <template x-for="(tag, index) in hit.tags" :key="tag">
            (
            <span>
                <span x-text="tag"></span>
                <span x-show="index < hit.hops.length - 1">, </span>
            </span>
            )
        </template>
    </span>
</div>
