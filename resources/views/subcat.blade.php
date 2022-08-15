<x-guest-layout>
<section class="breadcrumbsWrapper ml-4">
    <div class="breadcrumbs">
        <a href="{{ route('category', ['cat_id' => $subcat->cat->id]) }}">
            {{ $subcat->cat->name }}
        </a>
        &nbsp;&gt;&nbsp;
        {{ $subcat->name }}
    </div>
    <p class="mt-2 ml-4 text-sm">{{ $amount }}&nbsp;点の商品</p>
</section>
<section class="ml-4 flex items-center">
</section>
<section>
    <div class="flex flex-wrap justify-evenly">
        @foreach($products as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</section>
<section class="paginationContainer my-8">
    <div class="paginationWrapper">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</section>
<nav class="ml-4">
    <ul class="subcats">
        @foreach($cat->subcats as $subcat)
            <li><a href="{{ route('category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">{{ $subcat->name }}</a></li>        
        @endforeach
    </ul>
</nav>
</x-guset-layout>