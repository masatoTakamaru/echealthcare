<x-guest-layout>
<section class="m-4">
    <h1>ショッピングカート</h1>
</section>
<section class="m-4">
    @if($items->count() == 0)
        <p>商品はありません。</p>
    @else
        <table>
        <tbody>
        @foreach($items as $item)
            <tr>
            <td class="w-1/4 pr-4"><img src="{{ $item->associatedModel->productphotos->first()->url }}"></td>
            <td>
                <ul>
                <li>{{ $item->name }}</li>
                <li class="text-price">{{ number_format($item->price) }}&nbsp;円</li>
                <li>
                    <form action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mb-4">
                            <input class="text-sm border-2 py-1 px-4 rounded-lg" type="submit" value="削除">
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
        <td>
            <span>小計&nbsp;:&nbsp;</span><span class="text-price">{{ number_format(Cart::getSubTotal()) }}&nbsp;円</span>
        </td>
        </tr>
        </tbody>
        </table>
        <div class="my-4 text-center">
            <a class="bg-primary py-2 px-10 rounded shadow" href="{{ route('checkout') }}">レジに進む</a>
        </div>
    @endif
</section>
</x-guest-layout>