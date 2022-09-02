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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="navigation-header w-full bg-pink">
    <div class="h-16 px-6 flex justify-between items-center">
        <a class="font-darkbrown" href="/">ECヘルスケア</a>
        <div class="inline-flex items-center">
            <div class="mr-4">
                <a class="relarive" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto mr-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <p class="label-extra-small">見つける</p>
                </a>
            </div>
            <div class="mr-4">
                <a class="relarive" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto mr-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <p class="label-extra-small">お気に入り</p>
                </a>
            </div>
            <div class="mr-4">
                <a class="relative" href="{{ route('user.cart.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto mr-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <div class="shoppingcart-counter">
                        <span class="text-center">{{ $cart_items->count() }}</span>
                    </div>
                    <p class="label-extra-small">カート</p>
                </a>
            </div>
            
            <button class="md:hidden" id="toggleMenuButton">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-auto mr-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <p class="label-extra-small">メニュー</p>
            </button>
            <!-- responsive menu -->
            <nav class="mr-6 hidden md:block">
                <div class="flex items-center">
                    @if(Auth::id())
                        <span class="bg-primary-blue p-2 mr-6">
                            {{ Auth::user()->last_name }}&nbsp;{{ Auth::user()->first_name }}
                        </span>
                    @endif
                    <ul class="flex">
                    @unless(Auth::id())
                        <li>
                            <a class="mr-4" href="{{ route('user.login') }}">ログイン&nbsp;<img src="{{ asset('icons/login.svg') }}"></a>
                        </li>
                        <li>
                            <a class="mr-4" href="{{ route('user.register') }}">会員登録</a>
                        </li>
                    @endunless
                    @if(Auth::id())
                        <li>
                            <a class="mr-4" href="{{ route('user.user.edit', ['user' => Auth::user()->id]) }}">マイアカウント</a>
                        </li>
                        <li>
                            <form action="{{ route('user.logout')}}" method="POST">
                                @csrf
                                <input type="submit" value="ログアウト">
                            </form>
                        </li>
                    @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- hamburger Menu -->
<nav class="HeaderHamburger hidden" id="HeaderHamburger">
    @if(Auth::id())
        <div class="bg-primary-blue p-2">
            <p>{{ Auth::user()->last_name }}&nbsp;{{ Auth::user()->first_name }}</p>
        </div>
    @endif
    <ul>
    @unless(Auth::id())
        <li>
            <a href="{{ route('user.login') }}">ログイン&nbsp;<img class="inline h-4 w-4" src="{{ asset('icons/login.svg') }}"></a>
        </li>
        <li>
            <a href="{{ route('user.register') }}">会員登録</a>
        </li>
    @endunless
    @if(Auth::id())
        <li>
            <a href="{{ route('user.user.edit', ['user' => Auth::user()->id]) }}">マイアカウント</a>
        </li>
        <li>
            <form action="{{ route('admin.logout')}}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    @endif
    </ul>
</nav>
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
    <!--middle navigation-->
    <nav class="under-top-nav">
        <ul class="mb-2">
            <li>
                <a class="font-bold" href="/">TOP</a>
            </li>
            <li>
                <a class="font-bold" href="#">支払い方法</a>
            </li>
            <li>
                <a class="font-bold" href="#">配送方法</a>
            </li>
            <li>
                <a class="font-bold" href="#">よくあるご質問</a>
            </li>
            <li>
                <a class="font-bold" href="#">ご注文方法</a>
            </li>
            <li>
                <a class="font-bold" href="#">店舗案内</a>
            </li>
        </ul>
    </nav>

    <div class="flex flex-wrap md:flex-nowrap mb-12 justify-center">
        <article class="p-2 mb-8 md:order-2">
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
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $("#toggleMenuButton").click(() => {
        if ($("#HeaderHamburger").is(":hidden")) {
            $("#HeaderHamburger").slideDown();
        } else {
            $("#HeaderHamburger").slideUp();
        }
    });
</script>
</body>
</html>