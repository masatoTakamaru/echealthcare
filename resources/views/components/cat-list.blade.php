<section class="mx-auto">
    <ul class="flex flex-wrap items-center">
    @foreach($cats as $cat)
        <li class="category-name p-2 w-1/2 md:w-1/3">
            <a class="flex items-center relative" href="{{ route('user.category', ['cat_id'=>$cat->id]) }}">
                <p class="text-sm">{{ $cat->name }}&nbsp;</p>
                <img class="category-icon w-6" src="{{ asset('images/category/categoryIcon0' . $cat->id . '.webp') }} ">
                <img class="h-6 w-6 absolute right-2" src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
            </a>
        </li>
    @endforeach
    </ul>
</section>
