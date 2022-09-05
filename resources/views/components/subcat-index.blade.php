<nav>
<ul class="md:flex">
    @foreach($cat->subcats as $subcat)
        <li class="border-b first:border-t">
            <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">
                <div class="relative py-2 pl-4">
                    <span class="text-sm">{{ $subcat->name }}</span>
                    <img class="h-6 w-6 absolute top-2 right-0" src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
                </div>
            </a>
        </li>
    @endforeach
</ul>
</nav>