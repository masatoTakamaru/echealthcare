<x-guest-layout>
<section class="section-parent">
    <h1 class="category-header">{{ $cat->name }}</h1>
    <p class="number-of-items">{{ $amount }}&nbsp;点の商品</p>
    <x-item-list :items="$items" />
</section>
<section class="pagination-container">
    <div class="pagination-inner">
        {{ $items->links('vendor.pagination.default') }}
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>