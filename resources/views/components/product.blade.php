<div class="product-card w-5/12 md:w-40 p-2">
    <div class="product-card-inner">
        <div class="product-header font-brown">
            {{ $product->header }}
        </div>
        <a href="{{ route('user.single', ['id' => $product->id]) }}">
            <div class="product-thumbnail-wrapper">
                <img class="product-thumbnail"
                    src="{{ asset($product->primaryphoto_url) }}">
            </div>
            <div class="product-name">
                {{ $product->name }}
            </div>
            <div class="product-price font-price mt-2">
                {{ number_format($product->price) }}円
            </div>
        </a>
    </div>
</div>
