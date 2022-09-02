<div class="item-card w-5/12 md:w-40 p-2">
    <div class="item-card-inner">
        <div class="item-header font-brown">
            {{ $item->header }}
        </div>
        <a href="{{ route('user.single', ['id' => $item->id]) }}">
            <div class="item-thumbnail-wrapper">
                <img class="item-thumbnail"
                    src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
            </div>
            <div class="item-name">
                {{ $item->name }}
            </div>
            <div class="item-price font-price mt-2">
                {{ number_format($item->price) }}円
            </div>
        </a>
    </div>
</div>
