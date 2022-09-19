<x-guest-layout>
<section class="single-item">
    <p class="item-header">{{ $item->header }}</p>
    <img class="main-photo" src="{{ asset('storage/itemPhotos/' . $mainimage_url) }}">
    <div class="other-photos">
        @foreach($item->itemimages as $image)
            <a href="{{ route('user.single', ['id' => $item->id, 'another' => $image->id]) }}">
                <img src="{{ asset('storage/itemPhotos/' . $image->url) }}">
            </a>
        @endforeach
    </div>
    <article>
        <p class="item-name">{{ $item->name }}</p>
        <p class="item-maker">{{ $item->maker }}</p>
        <p>シリアル番号&nbsp;:&nbsp;[{{ $item->serial }}]</p>

        <p class="item-price"><span>&yen{{ number_format($item->price) }}</span>&nbsp;税込</p>
    </article>
    <div class="purchase-form">
        @if($max_quantity)
            {{-- purchase form --}}
            <form action="{{ route('user.cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $item->id }}">
                <label for="quantity">数量&nbsp;:&nbsp;</label>
                <select id="quantity" name="quantity">
                    @for($i = 1; $i <= $max_quantity; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <input class="purchase-button" type="submit" value="カートに入れる" />
            </form>
        @else
            <p>在庫なし</p>
        @endif
        {{-- favorite --}}
        @if($favorite_id)
            <form action="{{ route('user.favorite.destroy', ['favorite' => $favorite_id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="favorite">
                    <div class="favorite-icon-wrapper">
                        <input type="image" class="favorite-icon" src="{{ asset('icons/ui/favorite-solid.svg') }}" alt="お気に入り登録済み">
                    </div>
                    <p>お気に入り</p>
                </div>
            </form>
        @else
            <form action="{{ route('user.favorite.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="favorite">
                    <div class="favorite-icon-wrapper">
                        <input type="image" class="favorite-icon" src="{{ asset('icons/ui/favorite.svg') }}" alt="お気に入り">
                    </div>
                    <p>お気に入り</p>
                </div>
            </form>
        @endif
    </div>
    <article>
        {{ $item->spec }}
    </article>
    {{-- way of payment --}}
    <div class="way-of-payment">
        <p>お支払い方法</p>
        <div class="payment-icons">
            <img src="{{ asset('icons/settlements/visa.svg') }}">
            <img src="{{ asset('icons/settlements/master.svg') }}">
            <img src="{{ asset('icons/settlements/jcb.webp') }}">
            <img src="{{ asset('icons/settlements/paypay.webp') }}">
            <img src="{{ asset('icons/settlements/rakutenpay.webp') }}">
        </div>
    </div>
    {{-- social icons --}}
    <ul class="social-icons">
        <li class="mx-4">
            <a class="text-xl font-darkbrown" href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/facebook.svg') }}">
            </a>
        </li>
        <li class="mx-4">
            <a class="text-xl font-darkbrown" href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/twitter.svg') }}">
            </a>
        <li class="mx-4">
            <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/line.svg') }}">
            </a>
        </li>
    </ul>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>