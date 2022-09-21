<ul class="subcat-index">
    @foreach($cat->subcats as $subcat)
        <li>
            <a href="{{ route('user.category', ['cat_id' => $cat->id, 'subcat_id' => $subcat->id]) }}">
                <p>{{ $subcat->name }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#888" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                </a>
        </li>
    @endforeach
</ul>