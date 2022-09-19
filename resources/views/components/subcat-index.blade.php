<ul class="subcat-index">
    @foreach($cat->subcats as $subcat)
        <li>
            <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">
                <p>{{ $subcat->name }}</p>
                <img src="{{ asset('icons/ui/chevron-right-gray.svg') }}">
            </a>
        </li>
    @endforeach
</ul>