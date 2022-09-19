<x-guest-layout>
<section class="section-cart">
    <h1>ショッピングカート</h1>
    @if($items->count() == 0)
        <p class="cart-empty-message">商品はありません。</p>
    @else
        <div class="cart-list">
            @foreach($items as $item)
                <div class="row-item">
                    <img class="item-photo" src="{{ 'storage/itemPhotos/' . $item->associatedModel->itemimages->first()->url }}">
                    <div class="item-description">
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

                            <input id="itemDelete" class="item-delete btn-cancel-mini" type="submit" value="削除">
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row-total">
                <p class="total-blank"></p>
                <p class="total">小計&nbsp;:&nbsp;<span class="price">&yen{{ number_format(Cart::getSubTotal()) }}</span></p>
            </div>
        </div>
        <div class="centered">
            <a class="btn-primary" href="{{ route('user.checkout') }}">レジに進む</a>
        </div>
    @endif
</section>
<script>
    document.querySelector('#itemDelete').addEventListener('click', (event) => {
        if(!confirm("購入をキャンセルしますか？")) return event.preventDefault();
    });
</script>
</x-guest-layout>

