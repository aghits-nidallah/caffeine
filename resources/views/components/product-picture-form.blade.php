<script>
    function replaceLabel(forInput) {
        let input = $(`#${forInput}`)
        let picture = input.prop('files');

        if (picture.length == 0) {
            alert('Tidak dapat membaca file.');
            input.val("");
            return;
        }

        if (picture[0].type != 'image/png'
                && picture[0].type != 'image/jpg'
                && picture[0].type != 'image/jpeg')
        {
            alert(`Format gambar tidak valid. Format gambar: ${picture[0].type}`);
            input.val("");
            return;
        }

        let image = URL.createObjectURL(picture[0])
        $(`label[for='${forInput}']`).html(`<img src="${image}" class="w-full h-full object-cover rounded" />`)
    }
</script>

<x-label>
    Foto Produk
</x-label>

@if (!$readonly)
    <x-label class="text-xs text-red-500">
        *Jika foto dibiarkan kosong, sistem akan secara otomatis menggunakan foto
        default. Foto pertama akan dijadikan preview dari produk Anda.
    </x-label>
@endif

<div class="block overflow-x-scroll mt-2">
    <div style="width: calc(0.25rem*36*{{ $counter }})">
        @for ($i = 0; $i < $counter; $i++)
            <div class="w-32 h-32 mr-4 float-left relative">
                <label for="picture_{{ $i }}" class="transition-colors duration-300 ease-in-out hover:bg-gray-100 flex items-center justify-center w-full h-full p-1 border border-gray-300 border-dashed rounded cursor-pointer">
                    @if (isset($picture_urls[$i]))
                        <img src="{{ $picture_urls[$i] }}" class="w-full h-full object-cover rounded" />
                    @else
                        <i class="fas fa-image"></i>
                    @endif
                </label>

                @if (!$readonly)
                    <input
                        type="file"
                        name="picture[]"
                        id="picture_{{ $i }}"
                        class="hidden"
                        onchange="replaceLabel('picture_{{ $i }}')" />
                @endif
            </div>
        @endfor
    </div>
</div>