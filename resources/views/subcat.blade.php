<x-guest-layout>
<section class="breadcrumbsWrapper ml-4 flex items-center">
    <div class="breadcrumbs">
        <a href="{{ route('user.category', ['cat_id' => $subcat->cat->id]) }}">
            <span class="text-sm">{{ $subcat->cat->name }}</span>
        </a>
        &nbsp;
        <img class="h-4 w-4 inline" src="{{ asset('icons/ui/chevron-right.svg') }}">
        &nbsp;
        <span class="text-sm">{{ $subcat->name }}</span>
    </div>
</section>
<p class="ml-4 my-2 text-sm">{{ $amount }}&nbsp;点の商品</p>
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
</x-guset-layout>