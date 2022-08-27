<x-guest-layout>
<section class="p-4">
    <x-subcat-index :cat="$cat" />
    <div class="font-brown font-bold ml-4">
        {{ $product->header }}
    </div>
    <div class="flex justify-center">
        <img class="w-full md:w-96 p-4" src="{{ asset($mainphoto_url) }}">
    </div>
    <div class="flex justify-center flex-wrap items-center">
        @foreach($product->productphotos as $photo)
            @if($photo->url == $product->primaryphoto_url)
                <a class="m-1 border" href="{{ route('user.single', ['id' => $product->id, 'another' => $photo->id]) }}">
                    <img class="w-14 p-1" src="{{ asset($photo->url) }}">
                </a>
            @else
                <a class="m-1 border" href="{{ route('user.single', ['id' => $product->id, 'another' => $photo->id]) }}">
                    <img class="w-14 p-1" src="{{ asset($photo->url) }}">
                </a>
            @endif
        @endforeach
    </div>
    <div class="font-bold text-justify">
        {{ $product->name }}
    </div>
    <div class="py-2">
        {{ $product->maker }}
    </div>
    <div class="font-price text-lg mb-4">
        {{ number_format($product->price) }}円
    </div>
    <div class="mb-4">
        @if($max_quantity)
            <form action="{{ route('user.cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">
                <label for="quantity">数量&nbsp;:&nbsp;</label>
                <select class="border-2 p-2 w-20" id="quantity" name="quantity">
                    @for($i = 1; $i <= $max_quantity; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <span class="ml-4 py-2 px-4 bg-primary rounded-lg">
                    <input type="submit" value="カートに入れる" />
                </span>
            </form>
        @else
            <p class="soldout">在庫なし</p>
        @endif
    </div>
    <div class="singleSerial">
        シリアル番号&nbsp;:&nbsp;[{{ $product->serial }}]
    </div>
    <div class="singleSpec text-justify">
        {{ $product->spec }}
    </div>
    <nav class="my-10">
        <ul class="flex justify-center items-center">
            <li class="mr-4"><a class="text-xl font-darkbrown" href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li class="mr-4"><a class="text-xl font-darkbrown" href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i>
            <li>
                <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48" style=" fill:#8b6d25;"><path d="M25.12,44.521c-2.114,1.162-2.024-0.549-1.933-1.076c0.054-0.314,0.3-1.787,0.3-1.787c0.07-0.534,0.144-1.36-0.067-1.887 c-0.235-0.58-1.166-0.882-1.85-1.029C11.48,37.415,4.011,30.4,4.011,22.025c0-9.342,9.42-16.943,20.995-16.943S46,12.683,46,22.025 C46,32.517,34.872,39.159,25.12,44.521z M18.369,25.845c0-0.56-0.459-1.015-1.023-1.015h-2.856v-6.678 c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015v7.694c0,0.561,0.459,1.016,1.023,1.016h3.879 C17.91,26.863,18.369,26.406,18.369,25.845z M21.357,18.152c0-0.56-0.459-1.015-1.023-1.015c-0.565,0-1.023,0.455-1.023,1.015 v7.694c0,0.561,0.459,1.016,1.023,1.016c0.565,0,1.023-0.456,1.023-1.016V18.152z M30.697,18.152c0-0.56-0.459-1.015-1.023-1.015 c-0.565,0-1.025,0.455-1.025,1.015v4.761l-3.978-5.369c-0.192-0.254-0.499-0.406-0.818-0.406c-0.11,0-0.219,0.016-0.325,0.052 c-0.419,0.139-0.7,0.526-0.7,0.963v7.694c0,0.561,0.46,1.016,1.025,1.016c0.566,0,1.025-0.456,1.025-1.016v-4.759l3.976,5.369 c0.192,0.254,0.498,0.406,0.818,0.406c0.109,0,0.219-0.018,0.325-0.053c0.42-0.137,0.7-0.524,0.7-0.963V18.152z M36.975,20.984 h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015c0-0.56-0.46-1.015-1.025-1.015h-3.879c-0.565,0-1.023,0.455-1.023,1.015 c0,0.001,0,0.001,0,0.003v3.842v0.001c0,0,0,0,0,0.001v3.845c0,0.561,0.46,1.016,1.023,1.016h3.879 c0.565,0,1.025-0.456,1.025-1.016c0-0.56-0.46-1.015-1.025-1.015h-2.856v-1.817h2.856c0.566,0,1.025-0.455,1.025-1.015 c0-0.561-0.46-1.016-1.025-1.016V20.984z"></path></svg>
                </a>
            </li>
        </ul>
    </nav>
</section>
</x-guest-layout>