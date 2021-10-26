<x-app-layout>
    <x-slot name="header">
        <h6 class="font-semibold">
            Pesanan Toko Saya
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-12 sm:col-span-6 lg:col-span-8">
                    @forelse ($orders as $order)
                        <x-checkout-display :checkout="$order" :show_as_seller="true" />
                    @empty
                        Belum ada pesanan ;)
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>