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
        <a href="#">お問い合わせ</a>
    </li>
    @if(Auth::id())
        <li>
            <a href="{{ route('user.edit', ['user' => Auth::user()->id]) }}">マイアカウント</a>
        </li>
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
    <nav>
        <ul class="flex justify-center items-center">
            <li class="mr-4"><a class="text-xl text-darkbrown" href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li class="mr-4"><a class="text-xl text-darkbrown" href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i>
            <li>
                <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48" style=" fill:#8b6d25;"><path d="M25.12,44.521c-2.114,1.162-2.024-0.549-1.933-1.076c0.054-0.314,0.3-1.787,0.3-1.787c0.07-0.534,0.144-1.36-0.067-1.887 c-0.235-0.58-1.166-0.882-1.85-1.029C11.48,37.415,4.011,30.4,4.011,22.025c0-9.342,9.42-16.943,20.995-16.943S46,12.683,46,22.025 C46,32.517,34.872,39.159,25.12,44.521z M18.369,25.845c0-0.56-0.459-1.015-1.023-1.015h-2.856v-6.678 c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015v7.694c0,0.561,0.459,1.016,1.023,1.016h3.879 C17.91,26.863,18.369,26.406,18.369,25.845z M21.357,18.152c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015 v7.694c0,0.561,0.459,1.016,1.023,1.016c0.565,0,1.023-0.456,1.023-1.016V18.152z M30.697,18.152c0-0.56-0.459-1.015-1.023-1.015 c-0.565,0-1.025,0.455-1.025,1.015v4.761l-3.978-5.369c-0.192-0.254-0.499-0.406-0.818-0.406c-0.11,0-0.219,0.016-0.325,0.052 c-0.419,0.139-0.7,0.526-0.7,0.963v7.694c0,0.561,0.46,1.016,1.025,1.016c0.566,0,1.025-0.456,1.025-1.016v-4.759l3.976,5.369 c0.192,0.254,0.498,0.406,0.818,0.406c0.109,0,0.219-0.018,0.325-0.053c0.42-0.137,0.7-0.524,0.7-0.963V18.152z M36.975,20.984 h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015c0-0.56-0.46-1.015-1.025-1.015h-3.879c-0.565,0-1.023,0.455-1.023,1.015 c0,0.001,0,0.001,0,0.003v3.842v0.001c0,0,0,0,0,0.001v3.845c0,0.561,0.46,1.016,1.023,1.016h3.879 c0.565,0,1.025-0.456,1.025-1.016c0-0.56-0.46-1.015-1.025-1.015h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015 c0-0.561-0.46-1.016-1.025-1.016V20.984z"></path></svg>
                </a>
            </li>
    
</a></li>
</a></li>
        </ul>
    </nav>
    <div class="flex flex-wrap mb-12">
        <article class="w-full md:order-2 mb-8">
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