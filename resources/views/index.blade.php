<x-guest-layout :show-header="true" :show-footer="true">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div>
            <h5 class="text-lg font-semibold">
                Produk Terbaru
            </h5>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 grid-flow-row gap-6 mt-2">
                @foreach ($newest_products as $product)
                    <x-product-display :product="$product" />
                @endforeach
            </div>
            <div class="flex justify-end">
                <a href="javascript:void(0)" class="mt-3">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="text-lg font-semibold">
                Rekomendasi Toko
            </h5>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 grid-flow-row gap-6 mt-2">
                @foreach ($store_recommendations as $store)
                    <x-store-display :store="$store" />
                @endforeach
            </div>
            <div class="flex justify-end">
                <a href="javascript:void(0)" class="mt-3">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="text-lg font-semibold">
                Produk Terpopuler
            </h5>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 grid-flow-row gap-6 mt-2">
                @foreach ($popular_products as $product)
                    <x-product-display :product="$product" />
                @endforeach
            </div>
            <div class="flex justify-end">
                <a href="javascript:void(0)" class="mt-3">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>