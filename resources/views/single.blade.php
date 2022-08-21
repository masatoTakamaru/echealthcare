<x-guest-layout>
<section class="p-4">
    <x-subcat-index :cat="$cat" />
    <div class="text-brown font-bold ml-4">
        {{ $product->header }}
    </div>
    <div class="flex justify-center">
        <img class="w-full md:w-96 p-4" src="{{ asset($mainphoto_url) }}">
    </div>
    <div class="flex justify-center flex-wrap items-center">
        @foreach($product->productphotos as $photo)
            @if($photo->url == $product->primaryphoto_url)
                <a class="m-1 border order-first" href="{{ route('user.single', ['id' => $product->id, 'another' => $photo->id]) }}">
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
    <div class="text-price text-lg mb-4">
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
</section>
</x-guest-layout>