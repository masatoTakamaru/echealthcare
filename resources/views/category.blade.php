<x-guest-layout>
<section class="ml-4 flex items-center">
    <h1>{{ $cat->name }}</h1>
    <p class="ml-4 text-sm">{{ $amount }}&nbsp;点の商品</p>
</section>
<section>
    <div class="flex flex-wrap justify-evenly">
        @foreach($items as $item)
            <x-item :item="$item" />
        @endforeach
    </div>
</section>
<section class="paginationContainer">
    <div class="paginationWrapper">
        {{ $items->links('vendor.pagination.default') }}
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>