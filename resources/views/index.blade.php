<x-guest-layout>
<section>
<h1 class="mt-6 font-bold border-b"><span class="text-xl text-primary">New Items</span> － 新着商品 －</h1>
<div class="products">
    <div class="products-inner flex flex-wrap justify-evenly sm:justify-start">
        @foreach($new_items as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</div>
</section>
<section>
    <h1 class="mt-6 font-bold border-b"><span class="text-xl text-primary">Recommends</span> － おすすめ商品 －</h1>
    <div class="products">
        <div class="products-inner flex flex-wrap justify-evenly sm:justify-start">
            @foreach($recommends as $product)
                <x-product :product="$product" />
            @endforeach
        </div>
    </div>
</section>    
</x-guest-layout>

