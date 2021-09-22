<div class="flex items-center">
    <img src="{{ $first_picture_url }}" class="w-8 h-8 rounded border mr-2" />
    <div class="flex flex-col w-48">
        <p class="font-semibold">
            {{ $name }}
        </p>
        <p class="line-clamp-2 text-gray-500">
            {{ $description }}
        </p>
    </div>
</div>