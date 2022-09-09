<li class="w-5/12 md:w-40 p-2">
    <div class="font-brown">
        {{ $item->header }}
    </div>
    <a href="{{ route('user.single', ['id' => $item->id]) }}">
        <div>
            <img src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
        </div>
        <div>
            {{ $item->name }}
        </div>
        <div class="font-price mt-1">
            &yen{{ number_format($item->price) }}
        </div>
    </a>
</li>
