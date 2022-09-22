<x-guest-layout>
<section>
    <div class="section-inner search">
        <form action="{{ route('user.search') }}" method="GET">
            <div class="search-form">
                <div class="search-form-inner">
                    <input type="text" name="keyword" max="255" placeholder="キーワードで探す (例) アイシャドウ" value="{{ $keyword }}">
                    <button class="search-button" type="submit">
                        <p>検索</p>
                        <img src="{{ asset('/images/ui/search-white.svg') }}">
                    </button>
                </div>
                <a href="/">
                    <img class="cancel-button" src="{{ asset('/images/ui/cancel.svg') }}">
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
