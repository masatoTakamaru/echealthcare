<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<section>
<h1>売り上げ履歴</h1>
<table class="border-2">
<thead class="border bg-blue-200">
    <tr>
        <th>日時</th>
        <th>商品名</th>
        <th>数量</th>
        <th>単価</th>
        <th>売上</th>
        <th>ユーザーID</th>
    </tr>
</thead>
<tbody>
@foreach($items as $item)
    <tr class="border even:bg-gray-200">
        <td>{{ $item->created_at }}</td>
        <td>{{ $item->item->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->price) }}</td>
        <td>{{ number_format($item->pricesum) }}</td>
        <td>{{ $item->user_id }}</td>
    </tr>
@endforeach
</tbody>
</table>
</section>
</x-app-layout>