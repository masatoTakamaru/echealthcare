<x-app-layout>
<h1>商品の新規登録</h1>
<form action="{{ route('admin.product.create') }}" method="GET">
    @csrf
    <label class="mt-2 block" for="name">カテゴリー</label>
    <select class="p-2 pr-10" name="cat_id">
        @foreach($cats as $cat)
            @if($cat->id == $current_cat_id)
                <option value="{{ $cat->id }}" name="cat_id" selected>{{ $cat->name }}</option>
            @else
                <option value="{{ $cat->id }}" name="cat_id">{{ $cat->name }}</option>
            @endif
        @endforeach
    </select>
    <input class="py-1 px-4 bg-blue-200 rounded" type="submit" value="選択">
</form>
<form action="{{ route('admin.product.store') }}" method="POST">
    @csrf
    <input type="hidden" name="cat_id" value="{{ $cat->id }}">
    <label class="mt-2 block" for="name">サブカテゴリー</label>
    <select class="p-2 pr-10" name="subcat_id">
        @foreach($cats->find($current_cat_id)->subcats as $subcat)
            <option value="{{ $subcat->id }}" name="subcat_id">{{ $subcat->name }}</option>
        @endforeach
    </select>

    <label class="mt-2 block" for="name">商品名</label>
    <input type="text" name="name" size="80" value="{{ old('name') }}">
    <label class="mt-2 block" for="serial">シリアル番号</label>
    <input type="text" name="serial" size="20" value="{{ old('serial') }}">
    <label class="mt-2 block" for="price">価格</label>
    <input type="number" name="price" size="80" value="{{ old('price') }}">
    <label class="mt-2 block" for="inventory">在庫数</label>
    <input type="number" name="inventory" size="80" value="{{ old('inventory') }}">
    <label class="mt-2 block" for="spec">規格</label>
    <textarea class="p-2" rows="10" cols="60" name="spec">{{ old('spec') }}</textarea>
    <label class="mt-2 block" for="header">ヘッダーメッセージ</label>
    <input type="text" name="header" size="80" value="{{ old('header') }}" placeholder="例）今なら20%OFF!!">
    <label class="mt-2 block" for="maker">製造業者</label>
    <input type="text" name="maker" size="40" value="{{ old('maker') }}">

    <input class="block mt-8 mb-20 bg-blue-200 py-2 px-4 rounded" type="submit" value="商品の登録">
</form>
</x-app-layout>