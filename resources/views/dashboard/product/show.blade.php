<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('dashboard.store.show', auth()->user()->id) }}" class="flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex flex-col">
                                <x-label for="name">Nama Produk</x-label>
                                <x-input type="text" name="name" id="name" value="{{ $product->name }}" class="mt-2 bg-gray-100" disabled />
                            </div>
                            <div class="flex flex-col mt-4">
                                <x-label for="description">Deskripsi Produk</x-label>
                                <textarea name="description" id="description" rows="8" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 bg-gray-100" disabled>{{ $product->description }}</textarea>
                            </div>
                            <div class="flex flex-col mt-4">
                                <x-label for="stock">Stok Produk</x-label>
                                <x-input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="mt-2 bg-gray-100" disabled />
                            </div>
                            <div class="flex flex-col mt-4">
                                <x-label for="price">Harga Produk (dalam Rupiah)</x-label>
                                <x-input type="number" name="price" id="price" value="{{ $product->price }}" class="mt-2 bg-gray-100" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
