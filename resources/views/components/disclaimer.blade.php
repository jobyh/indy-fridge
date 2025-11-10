<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('disclaimer', {
            show: Alpine.$persist(true).as('disclaimer-open'),
            open() {
                this.show = true
            },
            close() {
                this.show = false
            }
        })

        Alpine.data('disclaimer', () => ({
            open() {
                this.$store.disclaimer.open()
                this.$nextTick(() => {
                    this.$refs['disclaimer-content'].scrollTo(0, 0)
                })
            }
        }))
    })
</script>
<div x-data="disclaimer">
    <button
        x-cloak
        @class([
            'fixed bottom-4 right-6 md:right-8 z-40 rounded-full',
            'bg-white p-2 shadow-lg text-gray-900',
            'cursor-pointer shadow-lg',
        ])
        x-on:click="open"
    >
        <x-icon.question class="w-6 h-6" />
        <span class="sr-only">About this app</span>
    </button>
    <div
        x-cloak
        x-show="$store.disclaimer.show"
        role="alert"
        @class([
            'z-50 absolute top-0 right-0 bottom-0 left-0',
            'backdrop-blur-lg p-6',
            'flex items-center justify-center',
        ])
    >
        <div @class([
            'py-6 max-w-sm lg:max-w-md',
            'bg-white rounded-xl shadow-lg text-gray-900',
            'max-h-full flex flex-col',
        ])>

            <div x-ref="disclaimer-content" class="h-full overflow-y-auto px-6">
                <x-type tag="h2" class="font-bold text-2xl text-center">Hey Indy Local 👋</x-type>
                <div class="flex flex-col gap-3 mt-3">
                    <x-type tag="p">
                        This is a web app I built to help me find beers I might like
                        in <x-type.link variant="dark" href="https://theindepdendent.pub">The Independent's</x-type.link> fridge and online store.
                    </x-type>
                    <x-type tag="p">
                        Every night, code elves visit the Indy's website
                        and update the items listed here ✨.
                    </x-type>
                    <x-type tag="p">
                        Try searching for a brewery you like, hop names
                        or beer styles like NEIPA, DDH or&nbsp;Sour.
                    </x-type>
                    <x-type tag="p">
                        Use the heart button to save beers you've
                        found and refer back to when you're fridge-diving
                        or delight Lydia by asking her to find them for you 😬.
                    </x-type>
                    <x-type tag="p">
                        You can sort results by most relevant to your
                        search term, price or ABV percentage.
                    </x-type>
                    <x-type tag="p">
                        I believe in online privacy. There are
                        no spooky tracking pixels here. Favourites are stored
                        on your device, no cookies are required.
                    </x-type>
                    <x-type tag="p">
                        This is an entirely unoffical, guerrilla coding project
                        not affiliated with the Independent, but made with love
                        for that excellent establishment 💜
                    </x-type>
                    <x-type tag="p" class="text-xl text-center mt-3">
                        Cheers! &ndash; <x-type.link variant="dark" class="!decoration-2" href="https://jobyharding.com">Joby</x-type.link>
                    </x-type>
                </div>

                <section class="mt-8">
                    <p @class([
                        'bg-amber-100 border-l-4 border-amber-300',
                        'py-1 px-4',
                    ])>
                        ⚠️ Confirm you are over 18 to proceed
                    </p>
                    <x-button
                        variant="primary"
                        class="mt-4 w-full"
                        x-on:click="$store.disclaimer.close()"
                    >
                        I'm over 18
                    </x-button>
                </section>

                <div class="flex justify-end">
                    <a class="mt-3 py-1 block" href="https://github.com/jobyh/indy-fridge">
                        <span>For the coders</span>
                        <x-icon.github class="w-6 h-6 inline-block" />
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
