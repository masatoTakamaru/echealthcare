<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>EC Healthcareサンプル</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/products.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/single.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout.css') }}" />
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
</head>
<body>
<header>
    <div class="headerInner">
        <a class="headerInfo" href="/">健康美容アイテム通販サイトサンプル</a>
        <nav class="HeaderNav">
            <a href="{{ route('cart.index') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <ul>
            <li class="clientInfo">
                <a class="login" href="{{ route('login.index') }}">ログイン</a>
            </li>
            <li class="clientInfo">
                <a class="login" href="#">会員登録</a>
            </li>
            <li class="clientInfo">
                <a class="login" href="#">マイアカウント</a>
            </li>
            <li class="clientInfo">
                <a class="login" href="#">お問い合わせ</a>
            </li>
            </ul>
        </nav>
        <div class="toggleMenuButtonWrapper">
            <div class="shoppingCart">
                <a href="{{ route('cart.index') }}">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="shoppingCartCounter">{{ $cart_items->count() }}</span>
                </a>
            </div>
            <button class="toggleMenuButton" id="toggleMenuButton">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>
<!-- hamburger Menu -->
<nav class="HeaderHamburger" id="HeaderHamburger">
    <ul>
    <li class="clientInfo">
        <a class="login" href="{{ route('login.index') }}">ログイン&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></a>
    </li>
    <li class="clientInfo">
        <a class="login" href="#">会員登録</a>
    </li>
    <li class="clientInfo">
        <a class="login" href="#">マイアカウント</a>
    </li>
    <li class="clientInfo">
        <a class="login" href="#">お問い合わせ</a>
    </li>
    </ul>
</nav>
<!-- main -->
<main>
    <div class="topImageWrapper">
        <div class="topLogo">
            <a class="logo" href="/">Healthcare</a>
        </div>
    </div>
    <nav class="headerUtilNav">
    <ul>
    <li>
        <a class="login" href="#">支払い方法</a>
    </li>
    <li>
        <a class="login" href="#">配送方法</a>
    </li>
    <li>
        <a class="login" href="#">よくあるご質問</a>
    </li>
    <li>
        <a class="login" href="#">ご注文方法</a>
    </li>
    <li>
        <a class="login" href="#">店舗案内</a>
    </li>
    </ul>
    </nav>
    <div class="contentWrapper">
        <aside>
            <!-- カテゴリメニュー -->
            <ul class="categories">
            @foreach($cats as $cat)
                <li class="categoryName">
                    <a href="{{ route('category', ['cat_id'=>$loop->iteration]) }}">
                        {{ $cat->name }}
                        &nbsp;
                        <img class="categoryIcon" src="{{ asset('images/category/categoryIcon0' . $loop->iteration . '.webp') }} ">
                    </a>
                </li>
            @endforeach
            </ul>
        </aside>
        <article>
            {{ $slot }}
        </article>
    </div>
</main>
<footer>
    @if (session('login_msg'))
        <div class="alert alert-success">
        {{ session('login_msg') }}
        </div>
        @endif

        @if (Auth::guard('members')->check())
        <div>ユーザーID {{ Auth::guard('members')->user()->userid }}でログイン中</div>
        @else
        <div>ログインしていません</div>
        @endif

        <ul>
          <li>ログイン状態: {{ Auth::check() }}</li>
          <li>管理者（Administrator）ログイン状態: {{ Auth::guard('administrators')->check() }}</li>
          <li>会員（members） ログイン状態: {{ Auth::guard('members')->check() }}</li>
        </ul>

        <div>
          <a href="/admin/logout">ログアウト</a>
        </div>
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