<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>EC Healthcareサンプル</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/guest.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal.css') }}" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body x-data="{ container: true, menu: false }">
<div x-show="container" x-transition>
<header class="header-nav">
<div class="header-nav-inner">
    <a href="/">
        <img src="{{ asset('header-logo.png') }}" alt="ECヘルスケア">
    </a>
    <nav class="header-nav-menu">
        <div>
            <a href="{{ route('user.search') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <p>見つける</p>
            </a>
        </div>
        <div>
            <a href="{{ route('user.favorite.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <p>お気に入り</p>
            </a>
        </div>
        <div>
            <a class="shoppingcart-icon" href="{{ route('user.cart.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <div class="shoppingcart-counter">
                    <span>{{ $cart_items->count() }}</span>
                </div>
                <p>カート</p>
            </a>
        </div>
        <button @click="container = false; menu = true">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <p>メニュー</p>
        </button>
    </nav>
</div>
</header>
<!-- main -->
<main>
    {{ $slot }}
</main>
<footer class="footer">
<section>
    <div class="footer-banner">
        <div class="footer-banner-header">
            <img src="{{ asset('/images/others/shipment.svg') }}">
            <p>宅配便<span class="bold-primary">600円</span></p>
        </div>
        <p>お買い上げ<span class="bold-primary">2,000円</span>以上で送料無料</p>
    </div>
    <div class="footer-banner">
        <div class="footer-banner-header">
            <img src="{{ asset('/images/others/freedial.svg') }}">
            <p class="bold-primary">0120-12-3456</p>
        </div>
        <p>10:00～18:00</p>
    </div>
</section>
<section>
    <ul>
        <li>
            <a href="/">TOP</a>
        </li>
        <li>
            <a href="#">店舗案内</a>
        </li>
        <li>
            <a href="#">ご注文方法</a>
        </li>
        <li>
            <a href="#">支払い方法</a>
        </li>
        <li>
            <a href="#">配送方法</a>
        </li>
        <li>
            <a href="#">よくあるご質問</a>
        </li>
    </ul>
</section>
<section>
    <p>合同会社&nbsp;トナカイ</p>
    <p>〒859-4764</p>
    <p>長崎県松浦市御厨町狩原免6-7-28-104</p>
    <p>TEL&nbsp;:&nbsp;0955-12-3456</p>
    <p class="py-6 text-center">EC&nbsp;Healthcare&nbsp;2022</p>
</section>
</footer>
</div>
<!-- popup menu -->
<nav x-cloak x-show="menu" x-transition id="popUpMenu" class="popUpMenu">
    <div>
        <div>
            <svg @click="container = true; menu = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cancel-button w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <ul>
        @unless(Auth::id())
            <li>
                <a class="login" href="{{ route('user.login') }}">
                    <span>ログイン&nbsp;</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="{{ route('user.register') }}">会員登録</a>
            </li>
        @endunless
        @if(Auth::id())
            <li>
                {{ Auth::user()->last_name }}&nbsp;{{ Auth::user()->first_name }}
            </li>
            <li>
                <a class="my-account" href="{{ route('user.user.edit', ['user' => Auth::user()->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>マイアカウント</span>
                </a>
            </li>
            <li>
                <form action="{{ route('user.logout')}}" method="POST">
                    @csrf
                    <div class="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <input type="submit" value="ログアウト">
                    </div>
                </form>
            </li>
        @endif
        </ul>
        <hr>
        {{-- category --}}
        <ul>
            @foreach($cats as $cat)
                <li>
                    <a href="{{ route('user.category', ['cat_id' => $cat->id]) }}">
                        <div class="category-list">
                            <span>{{ $cat->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#888" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <hr>
        <ul>
            <li>
                <a href="/">TOP</a>
            </li>
            <li>
                <a href="#">店舗案内</a>
            </li>
            <li>
                <a href="#">ご注文方法</a>
            </li>
            <li>
                <a href="#">支払い方法</a>
            </li>
            <li>
                <a href="#">配送方法</a>
            </li>
            <li>
                <a href="#">よくあるご質問</a>
            </li>
        </ul>
    </div>
</nav>
{{-- flash message --}}
@if (session('flashmessage'))
    <div x-data="{ open: true }">
        <div class="modal__container" x-show="open">
            <div @click="open = false" class="modal__overlay"></div>
            <div class="modal__body">
                <div class="modal__main">
                    <div class="modal__content">
                        <div class="modal__content__inner">
                            <span>{{ session('flashheader') }}</span>
                            <svg @click="open = false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <hr>
                        <p>{{ session('flashmessage') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script>

</script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
</body>
</html>