<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>EC Healthcareサンプル</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
</head>
<body class="pt-10">
<header class="fixed top-0 z-10 w-full">
    <div class="bg-pink h-10 px-2 flex justify-between items-center">
        <a class="text-darkbrown" href="/">健康美容アイテム通販サイトサンプル</a>
        <div class="flex">
            <div class="mr-4">
                <a href="{{ route('cart.index') }}">
                    <i class="fa fa-shopping-cart text-xl text-darkbrown" aria-hidden="true"></i>
                    <span class="shoppingcart-counter text-darkbrown">{{ $cart_items->count() }}</span>
                </a>
            </div>
            <button class="mr-2" id="toggleMenuButton">
                <i class="fa fa-bars text-xl text-darkbrown" aria-hidden="true"></i>
            </button>
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
            <a href="{{ route('login') }}">ログイン&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
        </li>
        <li>
            <a href="{{ route('register') }}">会員登録</a>
        </li>
    @endunless
    <li>
        <a href="#">マイアカウント</a>
    </li>
    <li>
        <a href="#">お問い合わせ</a>
    </li>
    @if(Auth::id())
        <li>
            <form action="{{ route('logout')}}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    @endif
    </ul>
</nav>
<!-- main -->
<main>
    <div class="topImage">
        <div class="topLogo">
            <a class="logo" href="/">Healthcare</a>
        </div>
    </div>
    <nav class="headerUtilNav">
    <ul class="flex flex-wrap justify-center">
    <li>
        <a href="#">支払い方法</a>
    </li>
    <li>
        <a href="#">配送方法</a>
    </li>
    <li>
        <a href="#">よくあるご質問</a>
    </li>
    <li>
        <a href="#">ご注文方法</a>
    </li>
    <li>
        <a href="#">店舗案内</a>
    </li>
    </ul>
    </nav>
    <div class="flex flex-wrap mb-12">
        <article class="md:order-2 mb-8">
            {{ $slot }}
        </article>
        <aside class="w-full md:order-1">
            <!-- カテゴリメニュー -->
            <ul class="categories">
            @foreach($cats as $cat)
                <li class="category-name ml-4">
                    <a class="flex" href="{{ route('category', ['cat_id'=>$loop->iteration]) }}">
                        {{ $cat->name }}
                        &nbsp;
                        <img class="category-icon w-6" src="{{ asset('images/category/categoryIcon0' . $loop->iteration . '.webp') }} ">
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