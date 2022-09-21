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
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffa99f" class="favorite-icon w-6 h-6">
                                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </button>
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
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="favorite-icon w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
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
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#1565C0" d="M45,35c0,2.209-1.791,4-4,4H7c-2.209,0-4-1.791-4-4V13c0-2.209,1.791-4,4-4h34c2.209,0,4,1.791,4,4V35z"/><path fill="#FFF" d="M15.186 19l-2.626 7.832c0 0-.667-3.313-.733-3.729-1.495-3.411-3.701-3.221-3.701-3.221L10.726 30v-.002h3.161L18.258 19H15.186zM17.689 30L20.56 30 22.296 19 19.389 19zM38.008 19h-3.021l-4.71 11h2.852l.588-1.571h3.596L37.619 30h2.613L38.008 19zM34.513 26.328l1.563-4.157.818 4.157H34.513zM26.369 22.206c0-.606.498-1.057 1.926-1.057.928 0 1.991.674 1.991.674l.466-2.309c0 0-1.358-.515-2.691-.515-3.019 0-4.576 1.444-4.576 3.272 0 3.306 3.979 2.853 3.979 4.551 0 .291-.231.964-1.888.964-1.662 0-2.759-.609-2.759-.609l-.495 2.216c0 0 1.063.606 3.117.606 2.059 0 4.915-1.54 4.915-3.752C30.354 23.586 26.369 23.394 26.369 22.206z"/><path fill="#FFC107" d="M12.212,24.945l-0.966-4.748c0,0-0.437-1.029-1.573-1.029c-1.136,0-4.44,0-4.44,0S10.894,20.84,12.212,24.945z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"/><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"/><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"/></svg>
                <img src="{{ asset('/icons/settlements/jcb.webp') }}">
                <img src="{{ asset('icons/settlements/paypay.webp') }}">
                <img src="{{ asset('icons/settlements/rakutenpay.webp') }}">
            </div>
        </div>
        {{-- social icons --}}
        <ul class="social-icons">
            <li>
                <a href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#3F51B5" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z"/><path fill="#FFF" d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z"/></svg>
                </a>
            </li>
            <li>
                <a href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#03a9f4" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"/><path fill="#fff" d="M36,17.12c-0.882,0.391-1.999,0.758-3,0.88c1.018-0.604,2.633-1.862,3-3 c-0.951,0.559-2.671,1.156-3.793,1.372C31.311,15.422,30.033,15,28.617,15C25.897,15,24,17.305,24,20v2c-4,0-7.9-3.047-10.327-6 c-0.427,0.721-0.667,1.565-0.667,2.457c0,1.819,1.671,3.665,2.994,4.543c-0.807-0.025-2.335-0.641-3-1c0,0.016,0,0.036,0,0.057 c0,2.367,1.661,3.974,3.912,4.422C16.501,26.592,16,27,14.072,27c0.626,1.935,3.773,2.958,5.928,3c-1.686,1.307-4.692,2-7,2 c-0.399,0-0.615,0.022-1-0.023C14.178,33.357,17.22,34,20,34c9.057,0,14-6.918,14-13.37c0-0.212-0.007-0.922-0.018-1.13 C34.95,18.818,35.342,18.104,36,17.12"/></svg>
                </a>
            <li>
                <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="40px" height="40px"><path fill="#00c300" d="M12.5,42h23c3.59,0,6.5-2.91,6.5-6.5v-23C42,8.91,39.09,6,35.5,6h-23C8.91,6,6,8.91,6,12.5v23C6,39.09,8.91,42,12.5,42z"/><path fill="#fff" d="M37.113,22.417c0-5.865-5.88-10.637-13.107-10.637s-13.108,4.772-13.108,10.637c0,5.258,4.663,9.662,10.962,10.495c0.427,0.092,1.008,0.282,1.155,0.646c0.132,0.331,0.086,0.85,0.042,1.185c0,0-0.153,0.925-0.187,1.122c-0.057,0.331-0.263,1.296,1.135,0.707c1.399-0.589,7.548-4.445,10.298-7.611h-0.001C36.203,26.879,37.113,24.764,37.113,22.417z M18.875,25.907h-2.604c-0.379,0-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687c0.379,0,0.687,0.308,0.687,0.687v4.521h1.917c0.379,0,0.687,0.308,0.687,0.687C19.562,25.598,19.254,25.907,18.875,25.907z M21.568,25.219c0,0.379-0.308,0.688-0.687,0.688s-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687s0.687,0.308,0.687,0.687V25.219z M27.838,25.219c0,0.297-0.188,0.559-0.47,0.652c-0.071,0.024-0.145,0.036-0.218,0.036c-0.215,0-0.42-0.103-0.549-0.275l-2.669-3.635v3.222c0,0.379-0.308,0.688-0.688,0.688c-0.379,0-0.688-0.308-0.688-0.688V20.01c0-0.296,0.189-0.558,0.47-0.652c0.071-0.024,0.144-0.035,0.218-0.035c0.214,0,0.42,0.103,0.549,0.275l2.67,3.635V20.01c0-0.379,0.309-0.687,0.688-0.687c0.379,0,0.687,0.308,0.687,0.687V25.219z M32.052,21.927c0.379,0,0.688,0.308,0.688,0.688c0,0.379-0.308,0.687-0.688,0.687h-1.917v1.23h1.917c0.379,0,0.688,0.308,0.688,0.687c0,0.379-0.309,0.688-0.688,0.688h-2.604c-0.378,0-0.687-0.308-0.687-0.688v-2.603c0-0.001,0-0.001,0-0.001c0,0,0-0.001,0-0.001v-2.601c0-0.001,0-0.001,0-0.002c0-0.379,0.308-0.687,0.687-0.687h2.604c0.379,0,0.688,0.308,0.688,0.687s-0.308,0.687-0.688,0.687h-1.917v1.23H32.052z"/></svg>
                </a>
            </li>
        </ul>
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>