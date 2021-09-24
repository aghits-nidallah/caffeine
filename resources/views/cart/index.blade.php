<x-guest-layout :show-header="true" :show-footer="false">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-12 sm:col-span-6 lg:col-span-8">
                    <div class="flex flex-col">
                        @forelse ($carts as $cart)
                            <x-cart-display :cart="$cart" />
                        @empty
                            Belum ada produk ;)
                        @endforelse
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 lg:col-span-4">
                    <div class="flex flex-col">
                        <div class="bg-white shadow-md rounded-md p-4">
                            <h6 class="font-bold mb-2">
                                Ringkasan Belanja
                            </h6>
                            @foreach ($carts as $cart)
                                <div class="flex justify-between items-center">
                                    <p>
                                        <span>
                                            {{ $cart->product->name }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            x{{ $cart->quantity }}
                                        </span>
                                    </p>
                                    <p class="text-right">
                                        Rp{{ number_format($cart->product->price * $cart->quantity, 0, 0, '.') }}
                                    </p>
                                </div>
                            @endforeach
                            <div class="border-t border-gray-300 my-2"></div>

                            @if (isset($cart))
                                <div class="flex justify-between items-center mb-2">
                                    <span>
                                        Total Harga ({{ $cart->sum('quantity') }} produk)
                                    </span>
                                    <span class="text-right font-semibold">
                                        Rp
                                        {{ 
                                            number_format(
                                                collect($cart->with('product')->get())
                                                    ->map(function($el) {
                                                        return $el->product->price * $el->quantity;
                                                    })->sum(), 0, 0, '.'
                                            )
                                        }}
                                    </span>
                                </div>
                                <div class="flex justify-end">
                                    <x-button>
                                        Beli ({{ $cart->sum('quantity') }})
                                    </x-button>
                                </div>
                            @else
                                Anda belum memasukkan produk ke keranjang.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(event, oldQuantity)
        {
            if ($(event.target).val() != oldQuantity) return $(event.target).parents('form').submit();

            return event.preventDefault();
        }
    </script>
</x-guest-layout>