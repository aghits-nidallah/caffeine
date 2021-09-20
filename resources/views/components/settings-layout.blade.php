@php
    $store = auth()->user()->store;
@endphp
<x-app-layout>
    <div class="py-12">
        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Pengaturan
                </h2>
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 grid-flow-row rounded-md shadow-md">
                <div class="col-span-3">
                    <div class="bg-white w-full h-full rounded-l-md border-r border-gray-300 flex flex-col">
                        <div class="px-4 py-2 font-bold border-b">
                            Toko
                        </div>
                        <a href="{{ route('dashboard.store.edit', $store->id) }}" class="px-4 py-2 border-b transition-colors hover:text-brown-500 {{ request()->routeIs('dashboard.store.*') ? 'text-brown-500 bg-gray-50' : '' }}">
                            Profil Toko
                        </a>
                    </div>
                </div>
                <div class="col-span-9">
                    <div class="bg-white w-full relative rounded-r-md p-4 h-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>