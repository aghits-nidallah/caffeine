<div class="flex flex-row border-b border-gray-300 mb-4 pb-4">
    <div class="w-40 h-40">
        <img src="{{ $checkout->product->first_picture_url }}" class="w-full h-full border rounded object-cover" />
    </div>
    <div class="flex flex-shrink flex-col ml-4 w-full">
        <h6 class="font-semibold">
            {{ $checkout->product->name }}
        </h6>
        <p class="line-clamp-3 leading-snug mt-2">
            {{ $checkout->product->description }}
        </p>
        <div class="flex items-center justify-between mt-2">
            <p class="text-gray-500">
                <i class="fas fa-store mr-1"></i>
                {{ $checkout->product->store->name }}
            </p>
            <div class="flex text-gray-500 text-sm self-end">
                <span>
                    {{ $checkout->quantity }}
                </span>
                <span>
                    <i class="fas fa-times fa-xs mx-1"></i>
                </span>
                <span>
                    {{ number_format($checkout->product->price, 0, 0, '.' )}} =
                </span>
                <span class="ml-2 text-gray-700 font-semibold">
                    Rp{{ number_format($checkout->product->price * $checkout->quantity, 0, 0, '.') }}
                </span>
            </div>
        </div>
        <div class="w-full flex justify-between items-center mt-4">
            <div class="flex flex-col">
                <label for="payment_steps" class="font-semibold mb-1">Cara Pembayaran</label>
                <p class="italic">Scan QRis disini</p>
            </div>

            @if (!$checkout->payment_file_path)
                <form action="{{ route('checkout.destroy', $checkout->id) }}" method="post" onsubmit="return confirm('Apakah Anda ingin menghapus produk ini dari list checkout Anda?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">
                        <i class="fas fa-trash"></i>
                    </x-danger-button>
                </form>
            @endif
        </div>
        <div class="w-full flex flex-col mt-4">
            @if ($checkout->payment_file_path)
                <div class="flex">
                    <div class="px-2 py-1 rounded bg-green-500 text-white text-sm">
                        Menunggu Konfirmasi
                    </div>
                </div>
            @else
                <label for="payment_receipt" class="font-semibold mb-1">
                    <span>
                        Upload Bukti Pembayaran
                    </span>
                    @if ($checkout->payment_file_path)
                        <span class="{{ (bool) $checkout->is_accepted ? 'text-green-500' : 'text-red-500' }}">
                            ({{ $checkout->is_accepted ? 'Sudah dikonfirmasi toko' : 'Belum dikonfirmasi toko' }})
                        </span>
                    @endif
                </label>
                <form action="{{ route('checkout.update', $checkout->id) }}" method="post" enctype="multipart/form-data" class="flex flex-col">
                    @csrf
                    @method('PUT')
                    <input type="file" name="payment_receipt" id="payment_receipt" required>
                    <div class="flex">
                        <x-button class="mt-1">
                            Kirim
                        </x-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>