<div class="item-container">
    <ul class="item-list">
        @foreach($items as $item)
            <li>
                <a href="{{ route('user.single', ['id' => $item->id]) }}">
                    <img src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
                    <p>{{ $item->name }}</p>
                    <p class="price">&yen&nbsp;{{ number_format($item->price) }}</p>
                </a>
            </li>
        @endforeach
        @for($i = 0; $i <= $items->count(); $i++)
            <span class="item-empty"></span>
        @endfor
    </ul>
</div>