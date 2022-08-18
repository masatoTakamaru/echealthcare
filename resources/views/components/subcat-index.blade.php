<nav class="ml-4">
    <ul class="subcats md:flex">
        @foreach($cat->subcats as $subcat)
            <li>
                <i class="fa fa-chevron-right text-gray-300" aria-hidden="true"></i>
                <a href="{{ route('category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">{{ $subcat->name }}</a>
            </li>        
        @endforeach
    </ul>
</nav>