<x-app-layout>
    <x-slot name="header">
        <h6 class="font-semibold">
            Edit Toko
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto">
            <div class="bg-white p-6 rounded-md shadow-md">
                <form action="{{ route('dashboard.store.update', $store->id) }}" enctype="multipart/form-data" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
            
                    <div class="flex flex-col">
                        <label for="banner">
                            Foto Banner Toko
                        </label>
                        <label for="banner">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ $store->banner_url }}" id="bannerPreview" class="w-full h-full rounded-md border mt-2 cursor-pointer object-cover" />
                            </div>
                        </label>
            
                        <input type="file" name="banner" id="banner" class="hidden" onchange="submitPicture('banner', 'bannerPreview')">
                    </div>
            
                    <div class="flex flex-col mt-4">
                        <label for="picture">
                            Foto Profil Toko
                        </label>
                        <label for="picture">
                            <img src="{{ $store->picture_url }}" id="picturePreview" class="w-20 h-20 rounded-full border mt-2 cursor-pointer object-cover" />
                        </label>
            
                        <input type="file" name="picture" id="picture" class="hidden" onchange="submitPicture('picture', 'picturePreview')" />
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="name">Nama Toko</label>
                        <x-input type="text" name="name" id="name" :value="$store->name" class="mt-2" />
                    </div>
                    <div class="flex flex-col mt-4">
                        <label for="description">
                            Deskripsi Toko
                            <span id="descriptionLength" class="text-sm">
                                ({{ strlen($store->description) }}/255)
                            </span>
                        </label>
                        <textarea name="description" id="description" rows="4" placeholder="Belum ada deskripsi" maxlength="255" onkeyup="countLength()" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2">{{ $store->description }}</textarea>
                    </div>
            
                    <div class="flex justify-end mt-4">
                        <x-button>
                            Simpan
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function countLength() {
            let length = $("#description").val().length;

            $("#descriptionLength").html(`(${length}/255)`);
        }

        function submitPicture(field, targetPreview) {
            let picture = $(`#${field}`).prop('files');

            if (picture.length == 0) {
                alert('Tidak dapat membaca file.');
                return;
            }

            if (picture[0].type != 'image/png'
                    && picture[0].type != 'image/jpg'
                    && picture[0].type != 'image/jpeg')
            {
                alert(`Format gambar tidak valid. Format gambar: ${picture[0].type}`);
                return;
            }

            $(`#${targetPreview}`).attr('src', URL.createObjectURL(picture[0]))
        }
    </script>
</x-app-layout>