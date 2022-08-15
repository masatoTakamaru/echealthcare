<x-guest-layout>
<section>
    <div class="singleHeader">
        {{ $product->header }}
    </div>
    <img class="singleThumbnail"
        src="{{ asset($main_photo->url) }}">
    <div class="singlePhotos">
        @foreach($product->productphotos as $photo)
            <a href="{{ route('single', ['id' => $product->id, 'another' => $photo->id]) }}">
                <img class="anotherThumbnail"
                    src="{{ asset($photo->url) }}">
            </a>
        @endforeach
    </div>
    <div class="singleName">
        {{ $product->name }}
    </div>
    <div class="singleMaker">
        {{ $product->maker }}
    </div>
    <div class="singlePrice">
        {{ number_format($product->price) }}円
    </div>
    <div class="orderForm">
        @if($max_quantity)
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">
                <label for="quantity">数量:</label>
                <select id="quantity" name="quantity">
                    @for($i = 1; $i <= $max_quantity; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <span>
                    <input type="submit" class="buttonInput" value="カートに入れる" />
                </span>
            </form>
        @else
            <p class="soldout">在庫なし</p>
        @endif
    </div>
    <div class="singleSerial">
        シリアル番号:[{{ $product->serial }}]
    </div>
    <div class="singleSpec">
        {{ $product->spec }}
    </div>
</section>
</x-guest-layout>