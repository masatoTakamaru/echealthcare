<x-guest-layout>
<section class="p-4">
    <div class="py-2 font-bold">
        {{ $item->name }}
    </div>
    <div class="flex justify-center">
        <img class="w-full md:w-96 p-4" src="{{ asset('storage/itemPhotos/' . $mainimage_url) }}">
    </div>
    <div class="flex justify-center flex-wrap items-center">
        @foreach($item->itemimages as $image)
            @if($image->url == $item->primaryimage_url)
                <a class="m-1 border" href="{{ route('user.single', ['id' => $item->id, 'another' => $image->id]) }}">
                    <img class="w-14 p-1" src="{{ asset('storage/itemPhotos/' . $image->url) }}">
                </a>
            @else
                <a class="m-1 border" href="{{ route('user.single', ['id' => $item->id, 'another' => $image->id]) }}">
                    <img class="w-14 p-1" src="{{ asset('storage/itemPhotos/' . $image->url) }}">
                </a>
            @endif
        @endforeach
    </div>
    <div class="font-brown font-bold my-2">
        {{ $item->header }}
    </div>
    <div class="my-2 text-sm">
        {{ $item->maker }}
    </div>
    <div class="font-price text-lg mb-4">
        &yen{{ number_format($item->price) }}
    </div>
    <div class="mb-4 flex items-center">
        @if($max_quantity)
            {{-- purchase form --}}
            <form action="{{ route('user.cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $item->id }}">
                <label for="quantity">数量&nbsp;:&nbsp;</label>
                <select class="border-2 p-2 w-20" id="quantity" name="quantity">
                    @for($i = 1; $i <= $max_quantity; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <span class="ml-2 py-2 px-4 bg-primary rounded shadow">
                    <input type="submit" value="カートに入れる" />
                </span>
            </form>
        @else
            <p>在庫なし</p>
        @endif
        {{-- favorite --}}
        @if($favorite_id)
            <form action="{{ route('user.favorite.destroy', ['favorite' => $favorite_id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="image" class="h-10 w-10 mt-2 ml-2 py-2 px-2 border rounded" src="{{ asset('icons/ui/favorite-solid.svg') }}" alt="お気に入り登録済み">
            </form>
        @else
            <form action="{{ route('user.favorite.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="image" class="h-10 w-10 mt-2 ml-2 py-2 px-2 border rounded" src="{{ asset('icons/ui/favorite.svg') }}" alt="お気に入り">
            </form>
        @endif
        </form>
    </div>
    <div>
        <span class="text-sm">シリアル番号&nbsp;:&nbsp;[{{ $item->serial }}]</span>
    </div>
    <div class="text-justify">
        {{ $item->spec }}
    </div>
</section>
<section class="border p-2">
    <h2 class="text-sm">お支払い方法</h2>
    <div class="flex flex-wrap items-center">
        <img class="mx-4" src="{{ asset('icons/settlements/visa.svg') }}">
        <img class="mx-4" src="{{ asset('icons/settlements/master.svg') }}">
        <img class="mx-4" src="{{ asset('icons/settlements/jcb.webp') }}">
        <img class="mx-4" src="{{ asset('icons/settlements/paypay.webp') }}">
        <img class="mx-4" src="{{ asset('icons/settlements/rakutenpay.webp') }}">
    </div>
</section>
{{-- social icons --}}
<nav class="my-8">
    <ul class="flex justify-center items-center">
        <li class="mx-4">
            <a class="text-xl font-darkbrown" href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/facebook.svg') }}">
            </a>
        </li>
        <li class="mx-4">
            <a class="text-xl font-darkbrown" href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/twitter.svg') }}">
            </a>
        <li class="mx-4">
            <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                <img src="{{ asset('icons/social/line.svg') }}">
            </a>
        </li>
    </ul>
</nav>
<x-subcat-index :cat="$cat" />
</x-guest-layout>