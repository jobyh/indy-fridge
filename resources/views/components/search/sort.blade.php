<div x-data="{ selectedSort: 'name' }" class="relative">
    <label for="sort" class="sr-only">Sort</label>
    <select id="sort" x-model="selectedSort" {{ $attributes->class([
        'rounded-lg border py-1.5',
        'border-gray-300 dark:border-600',
        'bg-gray-100 dark:bg-gray-700',
        'appearance-none',
        'focus:outline-none',
        'cursor-pointer',
        'text-transparent',
        'w-12 h-full overflow-hidden',
    ]) }}>
        <option value="name">A-Z</option>
        <option value="added">Recent</option>
        <option value="abv">ABV low</option>
        <option value="abv">ABV high</option>
    </select>
    <div class="absolute inset-y-0 w-full h-full flex items-center pointer-events-none">
        <x-icon.sort class="w-5 h-5 mx-auto" />
    </div>
</div>
