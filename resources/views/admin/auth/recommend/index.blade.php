<x-app-layout>
<h1>おすすめ商品</h1>
<table>
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
@foreach($items as $item)
    <tr class="even:bg-gray-200">
        <td class="px-2 text-right">{{ $item->item->id }}</td>
        <td><a class="text-blue-600 underline" href="{{ route('admin.item.edit', ['item' => $item->item->id]) }}">{{ $item->item->name }}</a></td>
        <td class="px-2">{{ $item->item->serial }}</td>
        <td class="text-right px-2">{{ number_format($item->item->price) }}</td>
        <td class="text-right px-2">{{ $item->item->inventory }}</td>
        <td class="px-2">{{ $item->item->subcat->cat->name }}</td>
        <td class="px-2">{{ $item->item->subcat->name }}</td>
        <td class="px-2">{{ $item->item->maker }}</td>
        <td class="px-2">{{ $item->created_at }}</td>
    </tr>
@endforeach
</tbody>
</table>
</x-app-layout>