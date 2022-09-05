<x-guest-layout>
<!--キャンペーン-->
<section>
    <div class="campaign flex flex-wrap gap-1 justify-center">
        <img src="{{ asset('2022-summer-campaign-badge.webp') }}">
        <img src="{{ asset('2022-skincare-features-badge.webp') }}">
    </div>
</section>
<!--新着商品-->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">New Items</span>&nbsp;新着商品</h1>
    <div class="new-items mt-4">
        @foreach($new_items as $item)
            <a class="w-36" href="{{ route('user.single', ['id' => $item->id]) }}">
                <img class="w-36" src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach
    </div>
</section>
<!--おすすめ商品-->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">Recommends</span>&nbsp;おすすめ</h1>
    <div class="recommends mt-4">
        @foreach($recommends as $item)
            <a class="w-36" href="{{ route('user.single', ['id' => $item->id]) }}">
                <img class="w-36" src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', 1)->first()->url) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach
    </div>
</section>
<!--カテゴリー一覧-->
<section>
    <h1 class="mt-6 border-b"><span class="text-xl font-primary font-railway">Category List</span>&nbsp;カテゴリー</h1>
    <div class="mt-4 flex flex-wrap">
    @foreach($cats as $cat)
        <div>
            <div class="flex items-center my-4 mx-4 text-sm">
                <a class="flex items-center font-bold" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">{{ $cat->name }}</a>
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
$(document).ready(() => {
    $('.new-items').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<div class="py-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg></div>',
        nextArrow: '<div class="py-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg></div>',
    });
        $('.recommends').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<div class="py-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg></div>',
        nextArrow: '<div class="py-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg></div>',
    });
});

</script>


