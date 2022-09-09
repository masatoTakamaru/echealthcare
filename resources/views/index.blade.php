<x-guest-layout>
<!-- campaign -->
<section>
    <div class="campaign flex flex-wrap gap-1 justify-center mb-4">
        <img src="{{ asset('2022-summer-campaign-badge.webp') }}">
        <img src="{{ asset('2022-skincare-features-badge.webp') }}">
    </div>
</section>
<!-- recommends -->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">Recommends</span>&nbsp;おすすめ</h1>
    <ul class="mt-4 flex flex-wrap">
        @foreach($recommends as $item)
            <li class="w-44 p-2">
                <a href="{{ route('user.single', ['id' => $item->id]) }}">
                    <img src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
                    <p class="mt-4">{{ $item->name }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</section>
<!-- new items -->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">New Items</span>&nbsp;新着商品</h1>
    <div class="swiper">
        <div class="swiper-wrapper mt-4">
            @foreach($new_items as $item)
                <div class="swiper-slide">
                    <div class="w-40">
                        <a href="{{ route('user.single', ['id' => $item->id]) }}">
                            <img class="w-36" src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}" alt="{{ $item->name }}">
                            <p class="mt-4">{{ $item->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>
<!-- super-sub category -->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">Category List</span>&nbsp;カテゴリー</h1>
    <div class="mt-4 flex flex-wrap">
    @foreach($cats as $cat)
        <div>
            <div class="flex items-center my-4 mx-4 text-sm">
                <a class="flex items-center font-bold" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">{{ $cat->name }}</a>
                <img class="category-icon h-6 w-6 ml-2" src="{{ asset('images/category/categoryIcon0' . $cat->id . '.webp') }} ">
            </div>
            <ul class="subcats ml-6">
                @foreach($cat->subcats as $subcat)
                    <li>
                        <img class="h-4 w-4 inline" src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
                        <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">{{ $subcat->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>          
    @endforeach
    </div>
</section>
</x-guest-layout>
<script>
const swiper = new Swiper('.swiper', {
    loop: true,
    slidesPerView: 2,
    centeredSlides: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        400: {
            slidesPerView: 3
        },
        750: {
            slidesPerView: 4
        },
        800: {
            slidesPerView: 5
        }

    }
});
</script>


