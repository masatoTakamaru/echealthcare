<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>EC Healthcareサンプル</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/modal.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ container: true, menu: false }">
<div class="container" x-show="container" x-transition>
<header class="navigation-header w-full bg-pink">
    <div class="h-16 px-6 flex justify-between items-center">
        <a class="font-darkbrown" href="/">ECヘルスケア</a>
        <div class="inline-flex items-center">
            <div class="mr-4">
                <a class="relative" href="{{ route('user.search') }}">
                    <img class="h-6 w-6 ml-auto mr-auto" src="{{ asset('icons/ui/search.svg') }}">
                    <p class="label-extra-small">見つける</p>
                </a>
            </div>
            <div class="mr-4">
                <a class="relative" href="{{ route('user.favorite.index') }}">
                    <img class="h-6 w-6 ml-auto mr-auto" src="{{ asset('icons/ui/favorite.svg') }}" alt="お気に入り">
                    <p class="label-extra-small">お気に入り</p>
                </a>
            </div>
            <div class="mr-4">
                <a class="relative" href="{{ route('user.cart.index') }}">
                    <img class="h-6 w-6 ml-auto mr-auto" src="{{ asset('icons/ui/cart.svg') }}">
                    <div class="shoppingcart-counter">
                        <span class="text-center">{{ $cart_items->count() }}</span>
                    </div>
                    <p class="label-extra-small">カート</p>
                </a>
            </div>
            <button @click="container = false; menu = true">
                <img class="h-6 w-6 ml-auto mr-auto" src="{{ asset('icons/ui/menu.svg') }}">
                <p class="label-extra-small">メニュー</p>
            </button>

        </div>
    </div>
</header>
<!-- main -->
<main>
    <!--top-logo-->
    <div class="flex justify-center items-center p-2 top-logo">
        <a href="/"><img class="p-2" src="{{ asset('top-logo.webp') }}"></a>
        <div class="h-full">
            <div class="border rounded shadow p-2 mr-2 h-full flex items-center" >
                <img src="{{ asset('free-ship-logo.webp') }}">
            </div>
        </div>
        <div class="h-full">
            <div class="border rounded shadow p-2 h-full flex items-center">
                <div>
                    <img src="{{ asset('inquiry.webp') }}">
                    <div class="mt-1 flex items-center justify-center">
                        <a href="#"><img src="{{ asset('inquiry-mail.webp') }}" alt="お問い合わせ"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap md:flex-nowrap mb-12 justify-center">
        <article class="p-2 mb-4 md:order-2">
            {{ $slot }}
        </article>
        <aside>
            <!-- カテゴリメニュー -->
            <ul class="categories">
            @foreach($cats as $cat)
                <li class="category-name p-2">
                    <a class="flex items-center" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">
                        <p>{{ $cat->name }}&nbsp;</p>
                        <img class="category-icon w-6" src="{{ asset('images/category/categoryIcon0' . $cat->id . '.webp') }} ">
                    </a>
                </li>
            @endforeach
            </ul>
        </aside>
    </div>
</main>
<footer class="bg-pink p-4">
<p>合同会社&nbsp;トナカイ</p>
<p>〒859-4764&nbsp;長崎県松浦市御厨町狩原免6-7-28-104</p>
<p>お問い合わせ&nbsp;:&nbsp;0955-12-3456</p>
<p class="py-6 text-center">EC&nbsp;Healthcare&nbsp;2022</p>
</footer>
</div>
<!-- popup menu -->
<nav x-cloak x-show="menu" x-transition id="popUpMenu" class="popUpMenu h-full w-full md:block bg-white">
    <div class="p-2">
        <div>
            <img @click="container = true; menu = false" class="h-6 w-6 mt-2 mr-4 ml-auto" src="{{ asset('icons/ui/cancel.svg') }}">
        </div>
        <ul>
        @unless(Auth::id())
            <li>
                <a class="mr-4 flex items-center" href="{{ route('user.login') }}">
                    <span>ログイン&nbsp;</span>
                    <img class="h-4 w-4" src="{{ asset('icons/ui/login.svg') }}">
                </a>
            </li>
            <li>
                <a class="mr-4" href="{{ route('user.register') }}">会員登録</a>
            </li>
        @endunless
        @if(Auth::id())
            <li>
                {{ Auth::user()->last_name }}&nbsp;{{ Auth::user()->first_name }}
            </li>
            <li>
                <a class="mr-4 flex items-center" href="{{ route('user.user.edit', ['user' => Auth::user()->id]) }}">
                    <img class="h-6 w-6 mr-2" src="{{ asset('icons/ui/user-circle.svg') }}">
                    <span>マイアカウント</span>
                </a>
            </li>
            <li>
                <form action="{{ route('user.logout')}}" method="POST">
                    @csrf
                    <div class="flex items-center">
                        <img class="h-6 w-6 mr-2" src="{{ asset('icons/ui/logout.svg') }}">
                        <input type="submit" value="ログアウト">
                    </div>
                </form>
            </li>
        @endif
        </ul>
        <hr>
        {{-- category --}}
        <ul class="mb-4">
            @foreach($cats as $cat)
                <li>
                    <a href="{{ route('user.category', ['cat_id' => $cat->id]) }}">
                        <div class="relative">
                            <span>{{ $cat->name }}</span>
                            <img class="h-6 w-6 mr-2 absolute top-0 right-0" src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <hr>
        <ul class="mb-4">
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
                        <div class="flex justify-between items-center">
                            <span>{{ session('flashheader') }}</span>
                            <img @click="open = false" class="h-6 w-6" src="{{ asset('icons/ui/cancel.svg') }}">
                        </div>
                        <hr class="my-4">
                        <p class="text-sm">{{ session('flashmessage') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

</script>
</body>
</html>