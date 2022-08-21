<x-guest-layout>
<section class="breadcrumbsWrapper ml-4 flex items-center">
    <div class="breadcrumbs">
        <a href="{{ route('user.category', ['cat_id' => $subcat->cat->id]) }}">
            {{ $subcat->cat->name }}
        </a>
        &nbsp;
        <i class="fa fa-chevron-right text-gray-300" aria-hidden="true"></i>
        &nbsp;
        {{ $subcat->name }}
    </div>
    <p class="ml-4 text-sm">{{ $amount }}&nbsp;点の商品</p>
</section>
<x-subcat-index :cat="$cat" />
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
</x-guset-layout>