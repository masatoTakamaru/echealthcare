<x-app-layout>
<section class="categoryHeaderWrapper">
    <h1 class="categoryHeader">{{ $cat->name }}</h1>
    <p class="categoryHeaderAmount">{{ $amount }}&nbsp;点の商品</p>
</section>
<nav>
    <ul class="catsubs">
        @foreach($cat->catsubs as $catsub)
            <li><a href="{{ route('category', ['cat_id' => $cat->id, 'catsub_id' => $catsub->id]) }}">{{ $catsub->name }}</a></li>        
        @endforeach
    </ul>
</nav>
<section class="productsWrapper">
    <div class="products" id="products">
        @foreach($products as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</div>
</section>
<section class="paginationContainer">
    <div class="paginationWrapper">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</section>
</x-app-layout>