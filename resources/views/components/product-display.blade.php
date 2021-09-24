<div class="bg-white border rounded shadow-sm">
    <div class="aspect-w-1 aspect-h-1 border-b">
        <img src="{{ $product->first_picture_url }}" class="w-full h-full object-cover" />
    </div>
    
    <div class="px-2 py-2">
        <a href="javascript:void(0)" class="text-sm line-clamp-1">
            {{ $product->name }}
        </a>
        <a href="javascript:void(0)" class="text-sm text-gray-500 line-clamp-1">
            <i class="fas fa-sm fa-store mr-1"></i>
            {{ $product->store->name }}
        </a>
        <p class="text-sm font-bold">
            Rp{{ number_format($product->price, 0, 0, '.') }}
        </p>

        <div class="flex justify-end">
            @guest
            @else
                @if (auth()->user()->cart()->where('product_id', $product->id)->exists())
                    <form action="{{ route('cart.destroy', auth()->user()->cart()->where('product_id', $product->id)->first()->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="cursor-pointer">
                            <i class="fas fa-sm fa-shopping-cart text-brown-400"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />

                        <button class="cursor-pointer">
                            <i class="fas fa-sm fa-shopping-cart"></i>
                        </button>
                    </form>
                @endif
            @endguest
        </div>
    </div>
</div>