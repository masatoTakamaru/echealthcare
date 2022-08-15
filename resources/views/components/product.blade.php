<div class="product-card w-5/12 p-2">
    <div class="product-card-inner">
        <div class="product-header text-brown">
            {{ $product->header }}
        </div>
        <a href="{{ route('single', ['id' => $product->id]) }}">
            <div class="product-thumbnail-wrapper">
                <img class="product-thumbnail"
                    src="{{ asset($product->productphotos->first()->url) }}">
            </div>
            <div class="product-name">
                {{ $product->name }}
            </div>
            <div class="product-price text-price mt-2">
                {{ number_format($product->price) }}円
            </div>
        </a>
    </div>
</div>
