<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>EC Healthcareサンプル</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="w-full">
    <div class="bg-pink h-10 px-2 flex justify-between items-center">
        <a class="font-darkbrown" href="/">健康美容アイテム通販サイトサンプル</a>
        <div class="flex items-center">
            <div class="mr-4">
                <a href="{{ route('user.cart.index') }}">
                    <i class="fa fa-shopping-cart text-xl font-darkbrown" aria-hidden="true"></i>
                    <span class="shoppingcart-counter font-darkbrown">{{ $cart_items->count() }}</span>
                </a>
            </div>
            <button class="mr-2 md:hidden" id="toggleMenuButton">
                <i class="fa fa-bars text-xl font-darkbrown" aria-hidden="true"></i>
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
                            <a class="mr-4" href="{{ route('user.login') }}">ログイン&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
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
            <a href="{{ route('user.login') }}">ログイン&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
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
    <!--header navigation-->
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
        <aside>
            <!-- カテゴリメニュー -->
            <ul class="categories">
            @foreach($cats as $cat)
                <li class="category-name p-2">
                    <a class="flex items-center" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">
                        <p class="font-bold">{{ $cat->name }}&nbsp;</p>
                        <img class="category-icon w-6" src="{{ asset('images/category/categoryIcon0' . $cat->id . '.webp') }} ">
                    </a>
                </li>
            @endforeach
            </ul>
        </aside>
        <article class="p-2 mb-8">
            {{ $slot }}
        </article>
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