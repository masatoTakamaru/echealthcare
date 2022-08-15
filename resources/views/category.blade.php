<x-guest-layout>
<section class="ml-4 flex items-center">
    <h1>{{ $cat->name }}</h1>
    <p class="ml-4 text-sm">{{ $amount }}&nbsp;点の商品</p>
</section>
<nav class="ml-4">
    <ul class="subcats">
        @foreach($cat->subcats as $subcat)
            <li><a href="{{ route('category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">{{ $subcat->name }}</a></li>        
        @endforeach
    </ul>
</nav>
<section>
    <div class="flex flex-wrap justify-evenly">
        @foreach($products as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</section>
<section class="paginationContainer">
    <div class="paginationWrapper">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</section>
</x-guest-layout>