<div class="flex flex-row border-b border-gray-300 mb-4 pb-4">
    <div class="w-40 h-40">
        <img src="{{ $checkout->product->first_picture_url }}" class="w-full h-full border rounded object-cover" />
    </div>
    <div class="flex flex-shrink flex-col ml-4 w-full">
        <div class="flex items-center justify-between">
            <h6 class="font-semibold">
                {{ $checkout->product->name }}
            </h6>

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

        @if ($show_as_seller)
            <div class="flex justify-between mt-4">
                <div class="flex flex-col">
                    <p class="font-semibold">Bukti Pembayaran</p>
                    <a href="{{ Storage::url($checkout->payment_file_path) }}" class="w-48 h-64 inline-block overflow-hidden rounded mt-2 border shadow" target="_blank">
                        <img src="{{ Storage::url($checkout->payment_file_path) }}" class="w-48 h-64 object-cover transition-transform duration-300 ease-in-out hover:scale-110" />
                        {{-- TODO: File berbentuk PDF --}}
                    </a>
                </div>

                <div class="flex flex-col items-end max-w-xs">
                    @if ($checkout->is_accepted)
                        <p class="font-semibold">Kirim Barang</p>
                        <p class="italic text-sm text-right mt-1">
                            Barang telah dikirim: {{ $checkout->expedition_note }}
                        </p>
                    @else
                        <p class="text-yellow-600 text-sm max-w-xs text-right">
                            Dengan menekan tombol di bawah, Anda perlu mengirimkan catatan pengiriman (ekspedisi, dan nomor resi)
                            ke pengguna. Stok barang akan berkurang secara otomatis setelah Anda menekan tombol di bawah.
                        </p>
                        <form action="{{ route('dashboard.order.update', $checkout) }}" method="post" class="flex flex-col items-end">
                            @csrf
                            @method('PUT')
                            <textarea name="expedition_note" id="expedition_note" rows="3" class="rounded border mt-1 max-w-xs w-full text-sm" placeholder="Ekspedisi JNT, Resi XXXXXXX"></textarea>
                            <x-button type="submit" class="mt-2">
                                Kirim
                            </x-button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <div class="w-full flex justify-between items-center mt-4">
                <div class="flex w-full justify-between">
                    <div class="flex flex-col max-w-xs">
                        <label for="payment_steps" class="font-semibold mb-1">Cara Pembayaran</label>
                        <p class="italic">{{ $checkout->store->payment_note }}</p>
                    </div>

                    <div class="flex flex-col max-w-xs items-end">
                        <label class="font-semibold mb-1">Catatan Toko:</label>
                        <p class="italic text-right">{{ $checkout->expedition_note }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col mt-4">
                @if ($checkout->payment_file_path)
                    <div class="flex items-end justify-between">
                        <div class="flex flex-col">
                            @if ($checkout->is_accepted)
                                @if ($checkout->has_arrived)
                                    <div class="px-2 py-1 rounded bg-green-500 text-white text-sm">
                                        Pesanan diterima
                                    </div>
                                @else
                                    <div class="px-2 py-1 rounded bg-yellow-500 text-white text-sm">
                                        Pesanan dalam pengiriman
                                    </div>
                                @endif
                            @else
                                <div class="px-2 py-1 rounded bg-blue-500 text-white text-sm">
                                    Menunggu Konfirmasi
                                </div>
                            @endif
                        </div>

                        @if (!$checkout->has_arrived)
                            <form action="{{ route('dashboard.order.update', $checkout) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="has_arrived" value="1" />
                                <x-button class="mt-2">
                                    Konfirmasi Pesanan Sampai
                                </x-button>
                            </form>
                        @endif
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
        @endif

    </div>
</div>