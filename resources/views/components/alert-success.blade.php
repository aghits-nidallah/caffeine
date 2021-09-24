<div class="bg-white px-3 py-3 shadow-md rounded-md fixed bottom-4 right-4 w-80 flex items-start z-[1000]">
    <i class="fas fa-exclamation-triangle text-green-500"></i>
    <div class="flex flex-col ml-2 w-full">
        <h6 class="font-semibold text-green-500">
            {{ $title }}
        </h6>
        <p class="leading-tight line-clamp-3">
            {{ $slot }}
        </p>
    </div>
    <button class="-m-1" onclick="$(() => { $(this).parent().remove() })">
        <i class="fas fa-times text-gray-500"></i>
    </button>
</div>