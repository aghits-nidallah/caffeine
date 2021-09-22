<x-app-layout>
    <div class="py-12">
        <x-slot name="header">
            <div class="flex items-center">
                <img src="{{ $store->picture_url }}" class="w-8 h-8 mr-4 rounded border" />
        
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $store->name }}
                </h2>

                <a href="{{ route('dashboard.store.edit', $store->id) }}" class="transition-colors duration-300 ease-in-out ml-4 hover:text-brown-500">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row gap-6">
                <div class="col-span-3">
                    <div class="bg-white w-full rounded-md shadow-md relative">
                        <div class="aspect-w-16 aspect-h-9 w-full">
                            <img src="{{ $store->banner_url }}" class="w-full h-full object-cover rounded-t-md border-b" />
                        </div>
                        <div class="w-full relative -mt-10">
                            <img src="{{ $store->picture_url }}" class="w-20 h-20 mr-4 rounded-full shadow-md border mx-auto" />
                        </div>
                        <div class="px-4 py-2 pb-4">
                            <h5 class="text-lg font-semibold text-center">
                                {{ $store->name }}
                            </h5>
                            <p class="text-center">
                                {!! $store->description ?? '<i>Belum ada deskripsi</i>'!!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-span-9">
                    <div class="bg-white w-full rounded-md shadow-md p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h6 class="font-semibold">
                                Produk Saya
                            </h6>
                            <a href="{{ route('dashboard.product.create') }}">
                                <x-button>
                                    Tambah Produk
                                </x-button>
                            </a>
                        </div>
                        
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $dataTable->scripts() }}
</x-app-layout>