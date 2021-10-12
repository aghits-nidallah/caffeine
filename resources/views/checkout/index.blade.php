<x-app-layout>
    <x-slot name="header">
        <h6 class="font-semibold">
            Checkout
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-12 sm:col-span-6 lg:col-span-8">
                    <div class="border-b border-gray-300 mb-4 pb-4">
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Nobis, iusto. Harum officia a modi ea dolore
                            corporis accusamus dolorem. Similique beatae
                            consequuntur minus corrupti dolor. Consectetur illo
                            sunt ut dolorum.
                        </p>
                    </div>
                    <div class="flex flex-col">
                        @forelse ($checkouts as $checkout)
                            <x-checkout-display :checkout="$checkout" />
                        @empty
                            Belum ada produk ;)
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>