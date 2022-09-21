<x-guest-layout>
<section>
    <div class="single-item">
        <p class="item-header">{{ $item->header }}</p>
        <img class="main-photo" src="{{ asset('storage/itemPhotos/' . $mainimage_url) }}">
        <div class="other-photos">
            @foreach($item->itemimages as $image)
                <a href="{{ route('user.single', ['id' => $item->id, 'another' => $image->id]) }}">
                    <img src="{{ asset('storage/itemPhotos/' . $image->url) }}">
                </a>
            @endforeach
        </div>
        <div>
            <p class="item-name">{{ $item->name }}</p>
            <p class="item-maker">{{ $item->maker }}</p>
            <p>シリアル番号&nbsp;:&nbsp;[{{ $item->serial }}]</p>

            <p class="item-price"><span>&yen{{ number_format($item->price) }}</span>&nbsp;税込</p>
        </div>
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
                    <button class="btn-primary btn-purchase">
                        <input type="submit" value="カートに入れる" />
                    </button>
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffa99f" class="w-6 h-6">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                              </svg>
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
            <li>
                <a href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/social/facebook.svg') }}">
                </a>
            </li>
            <li>
                <a href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/social/twitter.svg') }}">
                </a>
            <li>
                <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/social/line.svg') }}">
                </a>
            </li>
        </ul>
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>