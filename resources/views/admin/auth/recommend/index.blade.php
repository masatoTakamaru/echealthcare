<x-app-layout>
<h1>おすすめ商品</h1>
<table class="border">
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
        <td class="px-2 text-right">{{ $item->product->id }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->product->serial }}</td>
        <td class="text-right px-2">{{ number_format($item->product->price) }}</td>
        <td class="text-right px-2">{{ $item->product->inventory }}</td>
        <td>{{ $item->product->subcat->cat->name }}</td>
        <td>{{ $item->product->subcat->name }}</td>
        <td>{{ $item->product->maker }}</td>
        <td>{{ $item->created_at }}</td>
    </tr>
@endforeach
</tbody>
</table>
</x-app-layout>