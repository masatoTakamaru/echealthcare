<x-guest-layout>
<section>
    <div class="section-inner">
        <h1>{{ $user->last_name }}&nbsp;{{ $user->first_name }}&nbsp;さんのお気に入り</h1>
        <div class="table">
            @foreach($favorites as $favorite)
                <div class="table-row">
                    <div class="table-cell">
                        <a href="{{ route('user.single', [ 'id' => $favorite->item_id ]) }}">
                            <img class="item-photo" src="{{ 'storage/itemPhotos/' . $favorite->item->itemimages->first()->url }}">
                        </a>
                    </div>
                    <div class="table-cell align-top">
                        <a href="{{ route('user.single', [ 'id' => $favorite->item_id ]) }}">
                            <p>{{ $favorite->item->name }}</p>
                        </a>
                        <p>&yen{{ number_format($favorite->item->price) }}</p>
                        <p>在庫数&nbsp;:&nbsp;{{ $favorite->item->inventory }}</p>
                        <form action="{{ route('user.favorite.destroy', ['favorite' => $favorite->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn-cancel-mini" value="削除" />
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="pagination-container">
    <div class="pagination-inner">
        {{ $favorites->links('vendor.pagination.default') }}
    </div>
</section>
</x-guest-layout>