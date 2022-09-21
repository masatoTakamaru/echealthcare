<x-guest-layout>
<section>
    <div class="section-inner search">
        <form action="{{ route('user.search') }}" method="GET">
            <div class="search-form">
                <div class="search-form-inner">
                    <input type="text" name="keyword" max="255" placeholder="キーワードで探す (例) アイシャドウ" value="{{ $keyword }}">
                    <button class="search-button" type="submit">
                        <p>検索</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </form>
        <hr>
        @if($items)
            @if($items->count() > 0)
                <div class="number-of-items">
                    <p>検索結果 : {{ $items->total() }}&nbsp;件</p>
                </div>
                <div class="result">
                    @foreach($items as $item)
                        <div class="item">
                            <a href="{{ route('user.single', ['id' => $item->id]) }}">
                                <img class="item-photo" src="{{ 'storage/itemPhotos/' . $item->itemimages->first()->url }}">
                                <p>{{ $item->name }}</p>
                                <p>&yen{{ number_format($item->price) }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <section class="pagination-container">
                    <div class="pagination-inner">
                        {{ $items->appends(request()->input())->links('vendor.pagination.default') }}
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
    </div>
</section>
</x-guest-layout>
