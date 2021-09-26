@php
    $product_in_cart = auth()->user()->cart()->where('product_id', $product->id);
    $product_exists_in_cart = $product_in_cart->exists();
@endphp
<x-guest-layout :show-header="true" :show-footer="false">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-12 grid-flow-row gap-6">
            <div class="col-span-12 md:col-span-8 grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-12 md:col-span-6 lg:col-span-5">
                    <x-product-detail-gallery :product="$product" />
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-7">
                    <h5 class="text-lg font-bold mb-2">
                        {{ $product->name }}
                    </h5>
                    <h3 class="text-2xl font-bold mb-4">
                        Rp{{ number_format($product->price, 0, 0, '.') }}
                    </h3>
                    <p class="mb-4">
                        {{ $product->description }}
                    </p>

                    <div class="flex">
                        <img src="{{ $product->store->picture_url }}" class="w-12 h-12 rounded-full border mr-2" />
                        <div class="flex flex-col">
                            {{-- TODO: Detail Toko --}}
                            <a href="javascript:void(0)">
                                {{ $product->store->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 md:col-span-4">
                <div class="bg-white rounded shadow">
                    <div class="px-3 py-3 border-b">
                        <h6 class="font-bold">
                            Atur jumlah
                        </h6>
                    </div>
                    <div class="px-3 py-3">
                        @if ($product_exists_in_cart)
                            <p class="text-red-500 mb-2">
                                *Produk sudah ada di keranjang
                            </p>
                        @endif

                        <form action="{{ $product_exists_in_cart
                                            ? route('cart.update', $product_in_cart->first()->id)
                                            : route('cart.store') }}" method="post">
                            @csrf
                            @if ($product_exists_in_cart)
                                @method('PUT')
                            @endif

                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <input type="hidden" name="max_quantity" value="{{ $product->stock }}" />
                            <div class="flex items-center mb-2">
                                <x-input type="number" class="w-16 mr-2 py-1" min="1" max="{{ $product->stock }}" name="quantity" value="{{ $product_exists_in_cart ? $product_in_cart->first()->quantity : 1 }}" />
                                <span>
                                    Stok {{ $product->stock}}
                                </span>
                            </div>
                            <div class="flex items-center justify-between mb-3">
                                <span>
                                    Subtotal
                                </span>
                                <span class="font-bold">
                                    Rp{{ number_format($product->price * ($product_in_cart->first()->quantity ?? 1), 0, 0, '.') }}
                                </span>
                            </div>
                            <div class="flex flex-col lg:flex-row justify-end">
                                @if ($product_exists_in_cart)
                                    <x-primary-button class="w-full lg:w-auto mr-0 md:mr-2 mb-2 md:!mb-0">
                                        Update Keranjang
                                    </x-primary-button>
                                @else
                                    <x-primary-button class="w-full lg:w-auto mr-0 md:mr-2 mb-2 md:!mb-0">
                                        + Keranjang
                                    </x-primary-button>
                                @endif

                                {{-- TODO: Beli langsung --}}
                                {{-- <x-button class="w-full lg:w-auto">
                                    Beli langsung
                                </x-button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- TODO: Sale info --}}
    {{-- TODO: Review --}}
    {{-- TODO: Discussion --}}
</x-guest-layout>