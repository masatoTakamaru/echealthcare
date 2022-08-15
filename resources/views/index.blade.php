<x-guest-layout>
<section>
<h1 class="ml-4 mt-6">－ 新着商品 －</h1>
<div class="products">
    <div class="products-inner flex flex-wrap justify-evenly">
        @foreach($new_items as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</div>
</section>
<section>
    <h1 class="ml-4 mt-6">－ おすすめ商品 －</h1>
    <div class="products">
        <div class="products-inner flex flex-wrap justify-evenly">
            @foreach($recommends as $product)
                <x-product :product="$product" />
            @endforeach
        </div>
    </div>
</section>    
</x-guest-layout>

