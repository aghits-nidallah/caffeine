<div class="aspect-h-1 aspect-w-1 mb-2">
    <img id="mainImage" src="{{ $product->first_picture_url }}" class="w-full h-full object-cover rounded border" />
</div>
@if ($product->pictures()->count() > 0)
    <div class="overflow-x-auto">
        <div style="width: calc(0.25rem*26*{{ $product->pictures()->count() }})" id="imageCarrousel">
            @foreach ($product->pictures as $picture)
                <img onclick="enlargeImage('{{ $picture->picture_url }}', {{ $loop->iteration-1 }})" src="{{ $picture->picture_url }}" class="w-24 h-24 cursor-pointer object-cover border rounded mr-2 float-left" />
            @endforeach
        </div>
    </div>
    <script>
        function enlargeImage(imageSrc, iteration)
        {
            $("#mainImage").attr('src', imageSrc)
            brightenImage(iteration)
        }

        function brightenImage(index)
        {
            $("#imageCarrousel").children().addClass('filter brightness-50')

            $($("#imageCarrousel").children()[index]).removeClass('filter brightness-50')
        }

        brightenImage(0)
    </script>
@endif