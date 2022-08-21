<x-app-layout>
<h1>ユーザー</h1>
<table class="border">
<thead class="bg-blue-200">
<tr>
    <th>ID</th>
    <th>名前</th>
    <th>フリガナ</th>
    <th>メールアドレス</th>
    <th>電話番号</th>
    <th>住所</th>
    <th>登録日時</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr class="even:bg-gray-200">
    <td>{{ $user->id }}</td>
    <td>{{ $user->last_name }}&nbsp;{{ $user->first_name }}</td>
    <td>{{ $user->last_name_kana }}&nbsp;{{ $user->first_name_kana }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone }}</td>
    <td>{{ $user->address }}</td>
    <td>{{ $user->created_at }}</td>
</tr>
@endforeach
</table>
<section class="paginationContainer mt-4">
    <div class="paginationWrapper">
        {{ $users->links('vendor.pagination.default') }}
    </div>
</section>
</x-app-layout>
