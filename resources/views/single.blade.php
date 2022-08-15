<x-guest-layout>
<section class="p-4">
    <div class="text-brown font-bold ml-4">
        {{ $product->header }}
    </div>
    <img class="w-full p-4" src="{{ asset($main_photo->url) }}">
    <div class="flex flex-wrap items-center">
        @foreach($product->productphotos as $photo)
            <a class="m-1 border" href="{{ route('single', ['id' => $product->id, 'another' => $photo->id]) }}">
                <img class="w-14 p-1" src="{{ asset($photo->url) }}">
            </a>
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
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">
                <label for="quantity">数量&nbsp;:&nbsp;</label>
                <select class="border-2 p-2" id="quantity" name="quantity">
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