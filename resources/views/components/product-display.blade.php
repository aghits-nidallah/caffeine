<div class="bg-white border rounded shadow-sm">
    <div class="aspect-w-1 aspect-h-1 border-b">
        <img src="{{ $product->first_picture_url }}" class="w-full h-full object-cover" />
    </div>
    
    <div class="px-3 py-2">
        <p class="text-sm line-clamp-1">
            {{ $product->name }}
        </p>
        <p class="text-sm font-bold">
            Rp{{ number_format($product->price, 0, 0, '.') }}
        </p>
    </div>
</div>