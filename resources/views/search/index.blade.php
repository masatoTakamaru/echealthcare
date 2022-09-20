<x-guest-layout>
<section>
    <div class="section-inner search">
        <form action="{{ route('user.search') }}" method="POST">
            @csrf
            <div class="search-form">
                <div class="search-form-inner">
                    <input type="text" name="keyword" max="255" placeholder="キーワードで探す (例) アイシャドウ" value="{{ $keyword }}">
                    <button class="search-button" type="submit">
                        <p>検索</p>
                        <img src="{{ asset('icons/ui/search-white.svg') }}">
                    </button>
                </div>
                <a href="{{ url()->previous() }}">
                    <img class="cancel-button" src="{{ asset('icons/ui/cancel.svg') }}">
                </a>
            </div>
        </form>
        <hr>
        @if($items)
            @if($items->count() > 0)
                <p>{{ $items->total() }}&nbsp;件</p>
                <div>
                    @foreach($items as $item)
                        <div>
                            <a href="{{ route('user.single', ['id' => $item->id]) }}">
                                <img src="{{ 'storage/itemPhotos/' . $item->itemimages->first()->url }}">
                                <p>{{ $item->name }}</p>
                                <p>&yen{{ number_format($item->price) }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <section class="pagination-container">
                    <div class="pagination-inner">
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
    </div>
</section>
</x-guest-layout>
