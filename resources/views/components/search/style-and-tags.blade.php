<div {{ $attributes->class('flex gap-1.5') }}>
    <span x-show="hit.tags.length > 0" class="flex items-start gap-x-1.5 flex-wrap">
        <x-type x-html="hit.style + (hit.tags.length > 0 ? ', ': '')"></x-type>
        <template x-for="(tag, index) in hit.tags" :key="tag">
            (
            <span>
                <span x-text="tag + ((index < hit.tags.length - 1) ? ', ' : '')"></span>
            </span>
            )
        </template>
    </span>
</div>
