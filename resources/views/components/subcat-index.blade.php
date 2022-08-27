<nav class="ml-4">
    <ul class="subcats md:flex flex-wrap mb-4">
        @foreach($cat->subcats as $subcat)
            <li>
                <i class="fa fa-chevron-right text-gray-300" aria-hidden="true"></i>
                <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">{{ $subcat->name }}</a>
            </li>
        @endforeach
    </ul>
</nav>