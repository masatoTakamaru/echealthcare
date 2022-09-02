<x-guest-layout>
<section class="p-4">
    <div class="font-brown font-bold ml-4">
        {{ $item->header }}
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
    <div class="font-bold text-justify">
        {{ $item->name }}
    </div>
    <div class="py-2">
        {{ $item->maker }}
    </div>
    <div class="font-price text-lg mb-4">
        {{ number_format($item->price) }}円
    </div>
    <div class="mb-4">
        @if($max_quantity)
            <form action="{{ route('user.cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $item->id }}">
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
        シリアル番号&nbsp;:&nbsp;[{{ $item->serial }}]
    </div>
    <div class="singleSpec text-justify">
        {{ $item->spec }}
    </div>
    {{-- social icons --}}
    <nav class="my-10">
        <ul class="flex justify-center items-center">
            <li class="mr-4">
                <a class="text-xl font-darkbrown" href="//www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&t=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/facebook.svg') }}">
                </a>
            </li>
            <li class="mr-4">
                <a class="text-xl font-darkbrown" href="//twitter.com/intent/tweet?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/twitter.svg') }}">
                </a>
            <li>
                <a href="//timeline.line.me/social-plugin/share?url={{ url()->current() }}&text=" target="_blank" rel="nofollow noopener noreferrer">
                    <img src="{{ asset('icons/line.svg') }}">
                </a>
            </li>
        </ul>
    </nav>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>