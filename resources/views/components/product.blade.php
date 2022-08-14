<div class="productCardWrapper">
    <div class="productCard">
        <div class="productHeader">
            {{ $product->header }}
        </div>
        <a href="{{ route('single', ['id' => $product->id]) }}">
            <div class="productThumbnailWrapper">
                <img class="productThumbnail"
                    src="{{ asset($product->productphotos->first()->url) }}">
            </div>
            <div class="productName">
                {{ $product->name }}
            </div>
            <div class="productPrice">
                {{ number_format($product->price) }}円
            </div>
        </a>
    </div>
</div>
