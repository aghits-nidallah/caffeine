<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('dashboard.store.show', auth()->user()->store) }}" class="flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.product.update', $product->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-product-picture-form counter="5" :product="$product" />
                        <div class="flex flex-col mt-4">
                            <x-label for="name">Nama Produk</x-label>
                            <x-input type="text" name="name" id="name" value="{{ $product->name }}" class="mt-2" required />
                        </div>
                        <div class="flex flex-col mt-4">
                            <x-label for="description">Deskripsi Produk</x-label>
                            <textarea name="description" id="description" rows="8" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="flex flex-col mt-4">
                            <x-label for="stock">Stok Produk</x-label>
                            <x-input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="mt-2" required />
                        </div>
                        <div class="flex flex-col mt-4">
                            <x-label for="price">Harga Produk (dalam Rupiah)</x-label>
                            <x-input type="number" name="price" id="price" value="{{ $product->price }}" class="mt-2" required />
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-button type="submit">
                                <i class="fas fa-save mr-2"></i>
                                Simpan
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
