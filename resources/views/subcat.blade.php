<x-app-layout>
<section class="breadcrumbsWrapper">
    <div class="breadcrumbs">
        <a href="{{ route('category', ['cat_id' => $catsub->cat->id]) }}">
            {{ $catsub->cat->name }}
        </a>
        &nbsp;&gt;&nbsp;
        {{ $catsub->name }}
    </div>
</section>
<section class="categoryHeaderWrapper">
    <h2 class="categoryHeader">{{ $catsub->name }}</h2>
    <p class="categoryHeaderAmount">{{ $amount }}&nbsp;点の商品</p>
</section>
<section class="productsWrapper">
    <div class="products" id="products">
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
<nav>
    <ul class="catsubs">
        @foreach($cat->catsubs as $sub)
            <li>
                <a href="{{ route('category', ['cat_id' => $cat->id, 'catsub_id' => $sub->id]) }}">
                    {{ $sub->name }}
                </a>
            </li>        
        @endforeach
    </ul>
</nav>
</x-app-layout>