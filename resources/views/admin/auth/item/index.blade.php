<x-app-layout>
<section class="py-2 flex items-center">
    <div class="mr-4">
        <form action="{{ route('admin.item.index') }}" method="GET">
            <input class="rounded" type="text" name="keyword" value="{{ $keyword }}">
            <span class="border p-1 bg-gray-300 rounded">
                <button type="submit">検索</button>
            </span>
        </form>
    </div>
    <div>
        <form action="{{ route('admin.item.index') }}" method="GET">
            <select class="p-2 rounded" name="cat_id">
                <option value="">カテゴリー</option>
                @foreach($cats as $cat)
                    @if($cat->id == $cat_id)
                        <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                    @else
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endif
                @endforeach
            </select>
            <span class="border p-1 bg-gray-300 rounded">
                <button type="submit">選択</button>
            </span>
        </form>
    </div>
    <div class="ml-8">
        <a class="py-2 px-4 bg-blue-200 rounded" href="{{ route('admin.item.create') }}">商品の新規登録</a>
    </div>
</section>
<section>
<table class="border w-full">
<thead class="bg-blue-200">
<tr>
    <th>ID</th>
    <th>商品名</th>
    <th>シリアル番号</th>
    <th>価格</th>
    <th>在庫数</th>
    <th>カテゴリー</th>
    <th>サブカテゴリー</th>
    <th>製造業者名</th>
    <th>登録日時</th>
</tr>
</thead>
<tbody>
@unless($items->count())
    <tr>
        <td colspan="9" class="text-center">商品はありません。</td>
    </tr>
@endunless
@foreach($items as $item)
    <tr class="even:bg-gray-200">
        <td class="px-2 text-right">{{ $item->id }}</td>
        <td><a class="text-blue-600 underline" href="{{ route('admin.item.edit', ['item' => $item->id]) }}">{{ $item->name }}</a></td>
        <td>{{ $item->serial }}</td>
        <td class="text-right px-2">{{ number_format($item->price) }}</td>
        <td class="text-right px-2">{{ $item->inventory }}</td>
        <td>{{ $item->subcat->cat->name }}</td>
        <td>{{ $item->subcat->name }}</td>
        <td>{{ $item->maker }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
@endforeach
</tbody>
</table>
</section>
<section class="paginationContainer mt-4">
    <div class="paginationWrapper">
        {{ $items->links('vendor.pagination.default') }}
    </div>
</section>
</x-app-layout>