<nav>
<ul class="flex flex-wrap">
    @foreach($cat->subcats as $subcat)
        <li class="w-full md:w-1/2">
            <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">
                <div class="relative py-2 pl-4">
                    <span class="text-sm">{{ $subcat->name }}</span>
                    <img class="h-6 w-6 absolute top-2 right-2" src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
                </div>
            </a>
        </li>
    @endforeach
</ul>
</nav>