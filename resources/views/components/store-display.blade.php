<div class="bg-white border rounded shadow-sm">
    <div class="aspect-w-1 aspect-h-1 border-b">
        <img src="{{ $store->picture_url }}" class="w-full h-full object-cover" />
    </div>
    
    <div class="px-3 py-2">
        <p class="text-sm line-clamp-1">
            {{ $store->name }}
        </p>
        <p class="text-sm text-gray-500 line-clamp-3">
            {{ $store->description }}
        </p>
    </div>
</div>