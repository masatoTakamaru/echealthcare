<x-app-layout>
<section>
<h1>－ 新着商品 －</h1>
<div class="productsWrapper">
    <div class="products">
        @foreach($new_items as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</div>
</section>
<section>
    <h1>－ おすすめ商品 －</h1>
    <div class="productsWrapper">
        <div class="products">
            @foreach($recommends as $product)
                <x-product :product="$product" />
            @endforeach
        </div>
    </div>
</section>    
</x-app-layout>

