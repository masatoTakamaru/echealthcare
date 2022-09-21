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
                <embed type="image/svg+xml" src="{{ asset('icons/ui/search.svg') }}">
                <p>見つける</p>
            </a>
        </div>
        <div>
            <a href="{{ route('user.favorite.index') }}">
                <img src="{{ asset('icons/ui/favorite.svg') }}">
                <p>お気に入り</p>
            </a>
        </div>
        <div>
            <a class="shoppingcart-icon" href="{{ route('user.cart.index') }}">
                <img src="{{ asset('icons/ui/cart.svg') }}">
                <div class="shoppingcart-counter">
                    <span>{{ $cart_items->count() }}</span>
                </div>
                <p>カート</p>
            </a>
        </div>
        <button @click="container = false; menu = true">
            <img src="{{ asset('icons/ui/menu.svg') }}">
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
            <img src="{{ asset('icons/others/shipment.svg') }}">
            <p>宅配便<span class="bold-primary">600円</span></p>
        </div>
        <p>お買い上げ<span class="bold-primary">2,000円</span>以上で送料無料</p>
    </div>
    <div class="footer-banner">
        <div class="footer-banner-header">
            <img src="{{ asset('icons/others/freedial.svg') }}">
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
            <img @click="container = true; menu = false" class="cancel-button" src="{{ asset('icons/ui/cancel.svg') }}">
        </div>
        <ul>
        @unless(Auth::id())
            <li>
                <a class="login" href="{{ route('user.login') }}">
                    <span>ログイン&nbsp;</span>
                    <img src="{{ asset('icons/ui/login.svg') }}">
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
                    <img src="{{ asset('icons/ui/user-circle.svg') }}">
                    <span>マイアカウント</span>
                </a>
            </li>
            <li>
                <form action="{{ route('user.logout')}}" method="POST">
                    @csrf
                    <div class="logout">
                        <img src="{{ asset('icons/ui/logout.svg') }}">
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
                            <img src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
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
                            <img @click="open = false" src="{{ asset('icons/ui/cancel.svg') }}">
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