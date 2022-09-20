<x-guest-layout>
<section class="section-cart">
    <div class="section-inner">
        <h1>ショッピングカート</h1>
        @if($items->count() == 0)
            <p class="cart-empty-message">商品はありません。</p>
        @else
            <div class="table w-full">
                @foreach($items as $item)
                    <div class="table-row">
                        <div class="table-cell photo-wrapper">
                            <img class="item-photo" src="{{ 'storage/itemPhotos/' . $item->associatedModel->itemimages->first()->url }}">
                        </div>
                        <div class="table-cell align-top item-description">
                            <p>{{ $item->name }}</p>
                            <p>個数&nbsp;:&nbsp;{{ $item->quantity }}</p>
                            @if($item->quantity == 1) 
                                <p>&yen{{ number_format($item->price) }}</p>
                            @else
                                <p class="font-price">&yen{{ number_format($item->getPriceSum()) }}(1個&nbsp;&yen{{ number_format($item->price) }})</p>
                            @endif
                            <form action="{{ route('user.cart.destroy', ['cart' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input id="itemDelete" class="btn-cancel-mini" type="submit" value="削除">
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class="table-row">
                    <div class="table-cell"></div>
                    <div class="table-cell total">
                        <p>小計&nbsp;:&nbsp;<span class="price">&yen{{ number_format(Cart::getSubTotal()) }}</span></p>
                    </div>
                </div>
            </div>
            <div class="centered">
                <a class="btn-primary" href="{{ route('user.checkout') }}">レジに進む</a>
            </div>
        @endif
    </div>
</section>
<script>
    document.querySelector('#itemDelete').addEventListener('click', (event) => {
        if(!confirm("購入をキャンセルしますか？")) return event.preventDefault();
    });
</script>
</x-guest-layout>

