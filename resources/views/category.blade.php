<x-guest-layout>
<section>
    <h1 class="section-header">{{ $cat->name }}</h1>
    <p class="number-of-items">{{ $amount }}&nbsp;็นใฎๅๅ</p>
    <x-item-list :items="$items" />
</section>
<section class="pagination-container">
    <div class="pagination-inner">
        {{ $items->links('vendor.pagination.default') }}
    </div>
</section>
<x-subcat-index :cat="$cat" />
</x-guest-layout>