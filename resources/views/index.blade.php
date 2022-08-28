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
    <h1 class="mt-6 font-bold border-b"><span class="text-xl font-primary">New Items</span> － 新着商品 －</h1>
    <div class="new-items mt-4">
        @foreach($new_items as $item)
            <a class="w-36" href="{{ route('user.single', ['id' => $item->id]) }}">
                <img src="{{ asset($item->primaryimage_url) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach
    </div>
</section>
<!--おすすめ商品-->
<section>
    <h1 class="mt-6 font-bold border-b"><span class="text-xl font-primary">Recommends</span> － おすすめ商品 －</h1>
    <div class="recommends mt-4">
        @foreach($recommends as $item)
            <a class="w-36" href="{{ route('user.single', ['id' => $item->id]) }}">
                <img src="{{ asset($item->primaryimage_url) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach
    </div>
</section>
<!--カテゴリー一覧-->
<section>
    <h1 class="mt-6 font-bold border-b"><span class="text-xl font-primary">Category List</span> － カテゴリー一覧 －</h1>
    <div class="mt-4 flex flex-wrap">
    @foreach($cats as $cat)
        <div>
            <div class="flex items-center my-4 mx-4 text-sm">
                <span class="material-icons font-pink">label_important</span>
                <a class="flex items-center font-bold" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">{{ $cat->name }}</a>
            </div>
            <ul class="subcats ml-8">
                @foreach($cat->subcats as $subcat)
                    <li >
                        <i class="fa fa-chevron-right text-gray-300" aria-hidden="true"></i>
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
        prevArrow: '<div class="p-2"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
        nextArrow: '<div class="p-2"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
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
        prevArrow: '<div class="p-2"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
        nextArrow: '<div class="p-2"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
    });
});

</script>


