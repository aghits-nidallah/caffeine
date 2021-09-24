<div class="flex flex-col sm:flex-row items-center sm:items-start min-h-[calc(0.25rem*32)] px-2 sm:px-0">
    <img src="{{ $cart->product->first_picture_url }}" class="w-32 h-32 mb-2 sm:mb-0 object-cover border rounded" />
    <div class="flex flex-col ml-0 sm:ml-4 w-full h-full justify-between">
        <div class="flex flex-col items-center sm:items-start mb-2 sm:mb-0">
            <a href="javascript:void(0)" class="text-lg font-semibold">
                {{ $cart->product->name}}
            </a>
            <p class="text-sm text-gray-500">
                Stok tersisa: {{ $cart->product->stock }}
            </p>
            <p class="line-clamp-2 mb-1">
                {{ $cart->product->description}}
            </p>
            <a href="javascript:void(0)" class="mb-1">
                <i class="fas fa-store mr-2"></i>
                {{ $cart->product->store->name }}
            </a>
        </div>
        <div class="flex items-center justify-center sm:justify-end">
            <form action="{{ route('cart.destroy', $cart->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <x-danger-button class="!px-2 mr-2">
                    <i class="fas fa-trash"></i>
                </x-danger-button>
            </form>
            <form action="{{ route('cart.update', $cart->id) }}" method="post">
                <div class="flex items-center">
                    @csrf
                    @method('PUT')
                    <x-input type="number" name="quantity" value="{{ $cart->quantity }}" max="{{ $cart->product->stock }}" class="w-24 mr-2" onblur="updateQuantity(event, {{ $cart->quantity }})" />
                    <input type="hidden" name="old_quantity" value="{{ $cart->quantity }}">
                    <input type="hidden" name="max_quantity" value="{{ $cart->product->stock }}">
                    <h6 class="font-bold">
                        Rp{{  number_format($cart->product->price * $cart->quantity, 0, 0, '.') }}
                    </h6>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="my-4 border-b"></div>