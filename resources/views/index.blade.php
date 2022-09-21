<x-guest-layout>
<!-- features -->
<section>
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-feature/01.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-feature/02.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-feature/03.png')}}">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-feature/04.png')}}">
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>
<!-- recommends -->
<section>
    <h1 class="section-header"><span>Recommends</span>おすすめ</h1>
    <x-item-list :items="$recommends" />
</section>
<!-- campaign1 -->
<section class="campaign1">
    <div>
        <img class="background-img" src="{{ asset('images/campaign/campaign01.png') }}">
        <div class="campaign-header">
            <p class="letter-space-large">大人気</p>
            <p>定番ブランド</p>
        </div>
    </div>
</section>
<!-- new items -->
<section>
    <h1 class="section-header"><span>New Items</span>新着商品</h1>
    <x-item-list :items="$new_items" :with_price="true" />
</section>
<!-- super-sub category -->
<section>
    <h1 class="section-header"><span>Category List</span>カテゴリーから探す</h1>
    <div class="cat-list">
        @foreach($cats as $cat)
            <div class="cat-items">
                <div class="cat-header">
                    <a href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">{{ $cat->name }}</a>
                    <img src="{{ asset('images/category/categoryIcon0' . $cat->id . '.webp') }} ">
                </div>
                <ul class="subcat-list">
                    @foreach($cat->subcats as $subcat)
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
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
    effect: 'fade',
    fadeEffect: {
        crossFade: true,
    },
    pagination: {
        el: ".swiper-pagination",
        type: 'bullets',
    },
    autoplay: {
        delay: 5000,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});

</script>


