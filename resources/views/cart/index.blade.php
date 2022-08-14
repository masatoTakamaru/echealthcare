<x-app-layout>
<section>
    <h1>ショッピングカート</h1>
</section>
<section>
    @if($items->count() == 0)
        <p>商品はありません。</p>
    @else
        <table>
        <tbody>
        @foreach($items as $item)
            <tr>
            <td><img class="cartItemThumbnail" src="{{ $item->associatedModel->productphotos->first()->url }}"></td>
            <td class="cartItemColumn">
                <ul>
                <li>{{ $item->name }}</li>
                <li class="cartItemPrice">{{ number_format($item->price) }}&nbsp;円</li>
                <li>
                    <form action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="cartItemDeleteButtonWrapper">
                            <input type="submit" class="cartItemDeleteButton" value="削除">
                        </div>
                    </form>
                </li>
                </ul>
            </td>
            </tr>
        @endforeach
        <tr>
        <td colspan="2"><hr></td>
        </tr>
        <tr>
        <td></td>
        <td class="cartSubTotal">
            <span>小計&nbsp;:&nbsp;</span><span class="cartSubTotalPrice">{{ number_format(Cart::getSubTotal()) }}&nbsp;円</span>
        </td>
        </tr>
        </tbody>
        </table>
        <div class="proceedToRetailCheckout">
            <a class="proceedToRetailCheckoutButton" href="{{ route('checkout') }}">レジに進む</a>
        </div>
    @endif
</section>
</x-app-layout>