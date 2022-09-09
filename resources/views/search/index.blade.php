<x-guest-layout>
<section>
<form action="{{ route('user.search') }}" method="POST">
    @csrf
    <div class="flex">
        <div class="flex-grow table-layout">
            <div class="h-10 box-border border">
                <input class="py-2 w-full border-none" type="text" name="keyword" max="255" placeholder="キーワードで探す (例) アイシャドウ" value="{{ $keyword }}">
            </div>
            <div class="bg-blue w-10 h-10 text-center box-border">
                <button class="align-middle" label="商品検索" type="submit">
                    <img class="h-6 w-6" src="{{ asset('icons/ui/search-white.svg') }}">
                </button>
            </div>
        </div>
        <a class="mx-4" href="{{ url()->previous() }}">
            <img class="h-8 w-8" src="{{ asset('icons/ui/cancel.svg') }}">
            <p class="label-extra-small">閉じる</p>
        </a>
    </div>
</form>
<hr class="my-4">
@if($items)
    @if($items->count() > 0)
        <p class="pl-4">{{ $items->total() }}&nbsp;件</p>
        <div class="flex flex-wrap justify-center">
            @foreach($items as $item)
                <div class="w-40">
                    <a class="p-2" href="{{ route('user.single', ['id' => $item->id]) }}">
                        <img class="w-36" src="{{ 'storage/itemPhotos/' . $item->itemimages->first()->url }}">
                        <p>{{ $item->name }}</p>
                        <p class="font-price">&yen{{ number_format($item->price) }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <section class="paginationContainer">
            <div class="paginationWrapper">
                {{ $items->links('vendor.pagination.default') }}
            </div>
        </section>
    @else
        <p>検索キーワードに一致する商品はありませんでした。</p>
        <h3>検索のヒント</h3>
        <ul>
            <li>誤字・脱字がないか確認してください</li>
            <li>別のキーワードを試してください</li>
        </ul>
    @endif
@endif
</section>
</x-guest-layout>
