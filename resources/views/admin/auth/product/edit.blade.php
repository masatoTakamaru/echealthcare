<x-app-layout>
<h1>商品の編集</h1>
<section>
    <form action="{{ route('admin.product.edit', ['product' => $item->id]) }}" method="GET">
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
        <input class="py-1 px-4 bg-white border rounded" type="submit" value="選択">
    </form>
    <form action="{{ route('admin.product.update', ['product' => $item->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="cat_id" value="{{ $cat->id }}">
        <label class="mt-2 block" for="name">サブカテゴリー</label>
        <select class="p-2 pr-10" name="subcat_id">
            @foreach($cats->find($current_cat_id)->subcats as $subcat)
                <option value="{{ $subcat->id }}" name="subcat_id">{{ $subcat->name }}</option>
            @endforeach
        </select>

        <label class="mt-2 block" for="name">商品名</label>
        <input type="text" name="name" size="80" value="{{ old('name') ?? $item->name }}">
        <label class="mt-2 block" for="serial">シリアル番号</label>
        <input type="text" name="serial" size="20" value="{{ old('serial') ?? $item->serial }}">
        <label class="mt-2 block" for="price">価格</label>
        <input type="number" name="price" size="80" value="{{ old('price') ?? $item->price }}">
        <label class="mt-2 block" for="inventory">在庫数</label>
        <input type="number" name="inventory" size="80" value="{{ old('inventory') ?? $item->inventory }}">
        <label class="mt-2 block" for="spec">規格</label>
        <textarea class="p-2" rows="10" cols="60" name="spec">{{ old('spec') ?? $item->spec }}"</textarea>
        <label class="mt-2 block" for="header">ヘッダーメッセージ</label>
        <input type="text" name="header" size="80" value="{{ old('header') ?? $item->header }}" placeholder="例）今なら20%OFF!!">
        <label class="mt-2 block" for="maker">製造業者</label>
        <input type="text" name="maker" size="40" value="{{ old('maker') ?? $item->maker }}">

        <input class="block mt-8 mb-10 bg-blue-200 py-2 px-4 rounded" type="submit" value="商品の更新">
    </form>
</section>
<section class="mb-20">
    <h1 class="my-4">メイン画像</h1>
    <img class="w-48" src="{{ asset($item->primaryphoto_url) }}">
    <h1 class="my-4">画像ファイル（最大 5 枚）：<span class="text-gray-600">画像をクリックするとメイン画像を変更できます。</span></h1>
    <div class="flex flex-wrap">
        @foreach($item->productphotos as $image)
            <div class="px-4">
                <div>
                    @if($image->url == $item->primaryphoto_url)
                        <img class="w-32 ring-4" src="/{{ $image->url }}">
                    @else
                        <form action="{{ route('admin.product.primaryphoto_update', ['product' => $image->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">
                                <img class="w-32 hover:opacity-70" src="{{ asset($image->url) }}">
                            </button>
                        </form>
                    @endif
                </div>
                <form action="{{ route('admin.productphoto.destroy', ['productphoto' => $image->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="text-center">
                        <input class="product-photo-delete mt-2 py-1 px-6 bg-white border rounded" type="submit" value="削除">
                    </div>
                </form>
            </div>
        @endforeach
    </div>
    @if($item->productphotos->count() < 5)
        <p class="text-sm py-2">新規画像ファイルの追加</p>
        <form action="{{ route('admin.productphoto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="new-image" type="file" name="new-image">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="bg-blue-200 py-2 px-4 rounded"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;画像のアップロード</button>
        </form>
    @endif
</section>
</x-app-layout>

<script>
    //削除の確認
    $(".product-photo-delete").on('click', () => {
        if(!confirm("削除してもよろしいですか？")) return false;
    });
</script>

