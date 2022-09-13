@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium font-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm font-red-600">
            @foreach ($errors->all() as $error)
                <li class="font-red-600">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
