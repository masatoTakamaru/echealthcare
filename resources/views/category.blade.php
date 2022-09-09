<x-guest-layout>
<section class="ml-4 flex items-center">
    <h1>{{ $cat->name }}</h1>
    <p class="ml-4 text-sm">{{ $amount }}&nbsp;点の商品</p>
</section>
<section>
    <ul class="flex flex-wrap justify-evenly">
        @foreach($items as $item)
            <x-item :item="$item" />
        @endforeach
        @for($i = 0; $i < $items->count(); $i++)
            <div class="w-5/12 md:w-40"></div>
        @endfor
    </ul>
</section>
<section class="paginationContainer">
    <div class="paginationWrapper">
        {{ $items->links('vendor.pagination.default') }}
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>