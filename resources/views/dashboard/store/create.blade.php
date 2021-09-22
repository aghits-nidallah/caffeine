<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Toko Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto">
            <div class="bg-white p-6 rounded-md shadow-md">
                <h5 class="text-lg font-semibold text-center mb-2">
                    Anda belum mempunyai toko
                </h5>
                <p class="mb-3">
                    Buat toko sekarang untuk menjual produk-produk yang Anda punya.
                    Tidak perlu ribet, hanya dengan satu klik, Anda sudah memiliki
                    toko. Tertarik? Buat toko sekarang!
                </p>
                <form action="{{ route('dashboard.store.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="flex justify-center">
                        <x-input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Toko" class="mr-2" required />
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                        <x-button>
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Buat Toko
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>