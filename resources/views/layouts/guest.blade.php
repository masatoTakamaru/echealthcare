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
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 32px; height: 32px;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#ff9438;}
                </style>
                <g>
                    <path class="st0" d="M497.568,60.446H252.044c-7.972,0-14.426,6.46-14.426,14.433v226.703c0,7.972,6.454,14.432,14.426,14.432
                        h245.524c7.972,0,14.432-6.46,14.432-14.432V74.879C512,66.906,505.54,60.446,497.568,60.446z"></path>
                    <path class="st0" d="M116.683,354.34c-26.836,0-48.606,21.764-48.606,48.6c0,26.85,21.77,48.614,48.606,48.614
                        c26.844,0,48.608-21.764,48.608-48.614C165.29,376.104,143.526,354.34,116.683,354.34z M116.683,424.826
                        c-12.079,0-21.871-9.799-21.871-21.886c0-12.073,9.792-21.865,21.871-21.865c12.08,0,21.872,9.792,21.872,21.865
                        C138.555,415.027,128.763,424.826,116.683,424.826z"></path>
                    <path class="st0" d="M403.8,354.34c-26.836,0-48.6,21.764-48.6,48.6c0,26.85,21.764,48.614,48.6,48.614
                        c26.843,0,48.606-21.764,48.606-48.614C452.406,376.104,430.643,354.34,403.8,354.34z M403.8,424.826
                        c-12.073,0-21.865-9.799-21.865-21.886c0-12.073,9.792-21.865,21.865-21.865c12.079,0,21.871,9.792,21.871,21.865
                        C425.671,415.027,415.879,424.826,403.8,424.826z"></path>
                    <path class="st0" d="M200.119,128.623H90.502c-3.561,0-6.957,1.582-9.23,4.331l-78.48,94.163C0.986,229.268,0,231.995,0,234.815
                        v82.595v43.19c0,6.648,5.389,12.029,12.03,12.029h36.836c11.634-25.9,37.629-44.024,67.817-44.024
                        c30.196,0,56.183,18.124,67.81,44.024h27.671V140.652C212.163,134.003,206.767,128.623,200.119,128.623z M43.931,236.053
                        c0-2.849,0.978-5.612,2.777-7.82l50.103-61.694c2.36-2.907,5.9-4.59,9.634-4.59h49.074c6.857,0,12.404,5.554,12.404,12.411v70.011
                        c0,6.849-5.547,12.404-12.404,12.404H56.327c-6.842,0-12.396-5.554-12.396-12.404V236.053z"></path>
                    <path class="st0" d="M243.532,338.792c-3.741,0-6.763,3.029-6.763,6.77v20.303c0,3.735,3.022,6.763,6.763,6.763h92.466
                        c6.374-14.209,17.072-26.023,30.419-33.836H243.532z"></path>
                    <path class="st0" d="M504.381,338.792h-63.19c13.346,7.814,24.045,19.627,30.419,33.836h32.771c3.741,0,6.763-3.028,6.763-6.763
                        v-20.303C511.144,341.821,508.122,338.792,504.381,338.792z"></path>
                </g>
                </svg>
                <p>宅配便<span class="bold-primary">600円</span></p>
        </div>
        <p>お買い上げ<span class="bold-primary">2,000円</span>以上で送料無料</p>
    </div>
    <div class="footer-banner">
        <div class="footer-banner-header">
            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 32px; height: 32px; opacity: 1;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#f65d75;}
                </style>
                <g>
                    <path class="st0" d="M0,88.032v52.377c40.301,0.061,77.768,7.802,110.13,20.584c6.062,2.395,11.941,4.965,17.636,7.703
                        c12.954-6.226,26.899-11.597,41.682-15.972c26.517-7.818,55.711-12.315,86.55-12.315c40.485,0,78.117,7.756,110.605,20.584
                        c6.062,2.395,11.945,4.965,17.632,7.703c12.958-6.226,26.903-11.597,41.686-15.972c26.383-7.772,55.413-12.27,86.08-12.315V88.032
                        H0z"></path>
                    <path class="st0" d="M320.59,286.652c0.008,13.233,3.993,25.381,10.859,35.57c6.865,10.166,16.618,18.26,28.016,23.071
                        c7.608,3.22,15.938,4.995,24.769,5.003c13.242-0.016,25.396-3.993,35.574-10.862c10.167-6.87,18.26-16.615,23.079-28.02
                        c3.213-7.604,4.991-15.934,4.995-24.761c0-6.311-1.315-13.004-4.089-20.011c-2.765-7.007-6.995-14.32-12.664-21.587
                        c-10.797-13.891-26.842-27.576-46.899-39.089c-15.375,8.843-28.414,18.925-38.508,29.443
                        c-10.751,11.16-18.125,22.758-21.915,33.551C321.63,275.146,320.59,281.037,320.59,286.652z"></path>
                    <path class="st0" d="M446.535,212.528c13.348,13.907,23.488,29.167,29.252,45.453c3.278,9.294,5.095,18.94,5.095,28.671
                        c0.012,19.95-6.096,38.63-16.515,54.036c-10.415,15.422-25.14,27.653-42.508,35.005c-11.57,4.896-24.322,7.603-37.624,7.603
                        c-19.957,0-38.646-6.096-54.052-16.523c-15.413-10.419-27.645-25.136-34.992-42.501c-4.9-11.574-7.608-24.326-7.604-37.62
                        c0-14.603,4.081-28.961,11.084-42.371c7.014-13.44,16.952-26.054,29.191-37.62c6.364-5.998,13.363-11.711,20.924-17.12
                        c-5.052-1.851-10.239-3.587-15.567-5.164c-23.514-6.93-49.603-10.968-77.222-10.968c-33.876-0.016-65.456,6.088-92.799,16.124
                        c9.99,7.13,18.998,14.84,26.868,22.995c13.341,13.907,23.484,29.167,29.248,45.453c3.282,9.294,5.099,18.94,5.099,28.671
                        c0.004,19.95-6.096,38.63-16.519,54.036c-10.419,15.422-25.14,27.653-42.504,35.005c-11.574,4.896-24.326,7.603-37.624,7.603
                        c-19.961,0-38.646-6.096-54.052-16.523c-15.417-10.419-27.648-25.136-34.996-42.501c-4.9-11.574-7.604-24.326-7.6-37.62
                        c0-14.603,4.077-28.961,11.076-42.371c7.018-13.44,16.956-26.054,29.199-37.62c6.36-5.998,13.359-11.711,20.921-17.12
                        c-5.057-1.851-10.236-3.587-15.567-5.164C53.367,177.493,27.446,173.454,0,173.409v250.559h512V173.409
                        c-33.696,0.045-65.112,6.135-92.329,16.124C429.66,196.663,438.668,204.374,446.535,212.528z"></path>
                    <path class="st0" d="M64.118,286.652c0.008,13.233,3.993,25.381,10.859,35.57c6.865,10.166,16.618,18.26,28.02,23.071
                        c7.604,3.22,15.934,4.995,24.769,5.003c13.234-0.016,25.392-3.993,35.57-10.862c10.17-6.87,18.26-16.615,23.078-28.02
                        c3.217-7.604,4.995-15.934,4.999-24.761c0-6.311-1.323-13.004-4.089-20.011c-2.769-7.007-6.999-14.32-12.663-21.587
                        c-10.802-13.891-26.85-27.576-46.903-39.089c-15.376,8.843-28.414,18.925-38.504,29.443c-10.751,11.16-18.125,22.758-21.915,33.551
                        C65.159,275.146,64.118,281.037,64.118,286.652z"></path>
                </g>
            </svg>
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