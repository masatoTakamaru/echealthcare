<x-guest-layout>
<section>
<h1 class="mb-4">{{ $user->last_name }}&nbsp;{{ $user->first_name }}&nbsp;さんのお気に入り</h1>
@foreach($favorites as $favorite)
    <div class="table mb-4">
        <a class="table-cell" href="{{ route('user.single', [ 'id' => $favorite->item_id ]) }}">
            <img class="w-20 table-cell p-2 box-border" src="{{ 'storage/itemPhotos/' . $favorite->item->itemimages->first()->url }}">
        </a>
        <div class="table-cell align-top">
            <a class="mb-4" href="{{ route('user.single', [ 'id' => $favorite->item_id ]) }}">
                <p>{{ $favorite->item->name }}</p>
            </a>
            <p>&yen{{ number_format($favorite->item->price) }}</p>
            <p class="text-sm">在庫数&nbsp;:&nbsp;{{ $favorite->item->inventory }}</p>
            <form action="{{ route('user.favorite.destroy', ['favorite' => $favorite->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" class="text-sm underline cursor-pointer" value="削除">
            </form>
        </div>
    </a>
    </div>
@endforeach
</section>
<section class="paginationContainer">
    <div class="paginationWrapper">
        {{ $favorites->links('vendor.pagination.default') }}
    </div>
</section>
</x-guest-layout>