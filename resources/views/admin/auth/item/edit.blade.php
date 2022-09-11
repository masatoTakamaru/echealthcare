<x-app-layout>
<h1>商品の編集</h1>
<section>
<form action="{{ route('admin.item.edit', ['item' => $item->id]) }}" method="GET">
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
<form action="{{ route('admin.item.update', ['item' => $item->id]) }}" method="POST" enctype="multipart/form-data">
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

    <label class="mt-2 block">画像ファイル（最大５枚）</label>
    <table class="bg-white">
    <thead>
        <tr>
            <th class="border-2">アップロード画像</th>
            <th class="border-2">画像の変更・削除</th>
        </tr>
    </thead>
    <tbody>
        @for($i = 1; $i <= 5; $i++)
            <tr class="border-2">
                {{-- uploaded preview --}}
                <td id="{{ 'preview' . $i }}" class="p-2 border-2">
                    @if($up_images[$i])
                        <div class="flex items-center">
                            <div>
                                <img class="w-36" src="{{ asset('storage/itemPhotos/' . $item->itemimages()->where('image_id', $i)->first()->url) }}">
                                @if($i == 1)
                                    <p class="text-center">メイン画像</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-center">画像はありません</p>
                    @endif
                </td>
                {{-- change or delete --}}
                <td class="p-2 border-2">
                    <div id="file{{ $i }}" class="flex items-center">
                        <input type="file" id="image{{ $i }}" class="p-2" name="image{{ $i }}" value="{{ old('image' . $i)}}">
                        <button type="button" id="image{{ $i }}-clear" class="bg-blue-200 py-1 px-4 mr-4 rounded">選択をクリア</button>
                    </div>
                    <input type="button" id="image{{$i}}DeleteButton" class="py-1 px-4 border-blue-200 border-2 bg-white rounded" name="image{{$i}}Delete" value="削除">
                    <input type="hidden" id="image{{$i}}Delete" name="imageDelete[{{ $i }}]">
                </td>
            </tr>
        @endfor
    </tbody>
    </table>

    <input class="mt-8 mb-10 bg-blue-200 py-2 px-4 rounded" type="submit" value="商品の更新">
</form>
</section>
<hr>
<h1 class="my-4">おすすめ商品</h1>
@if(!$recommend)
<section>
    <form class="flex justify-end mb-20" action="{{ route('admin.recommend.store') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <input class="bg-blue-200 py-2 px-4 mr-6 rounded" type="submit" value="おすすめ商品として登録">
    </form>
</section>
@else
<section>
    <form class="flex justify-end mb-20" action="{{ route('admin.recommend.destroy', ['recommend' => $item->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <input class="bg-white py-2 px-4 mr-6 rounded border" type="submit" value="おすすめ商品の登録を解除する">
    </form>
</section>
@endif
<hr>
<section>
<h1 class="my-4">商品の削除</h1>
<p>削除した商品は元に戻せません。</p>
<form class="flex justify-end mb-20" action="{{ route('admin.item.destroy', ['item' => $item->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <button id="itemDelete" class="bg-white py-2 px-4 mr-6 rounded border" type="submit">商品を削除</button>
</form>
</section>
</x-app-layout>

<script>

//初期化
const up_images = @json($up_images);
window.addEventListener('DOMContentLoaded', () => {
    for(i = 1; i <= 5; i++) {
        if(up_images[i]) { //アップロードされた画像が存在する
            document.querySelector('#file' + i).style.display = 'none';
        } else { //存在しない
            document.querySelector('#image' + i + 'DeleteButton').style.display = 'none';
        }
    }
});

for(let i = 1; i <= 5; i++) {

    //プレビューの表示
    const showPreview = (event) => {
        const fileData = event.target.files[0];
        if(fileData.type.match('image/*')) {
            let fileReader = new FileReader();
            fileReader.addEventListener('load', () => {
                document.querySelector('#preview' + i).innerHTML = `<img class="w-36" src="${fileReader.result}">`;
            });
            if(fileData) fileReader.readAsDataURL(fileData);
        } else {
            document.querySelector('#preview' +i).innerHTML = '<p>ファイル形式が画像ではありません</p>';
        }
    }

    //ファイルが選択された場合
    document.querySelector('#image' + i).addEventListener('change', showPreview);

    //選択をクリアがクリックされた場合
    document.querySelector('#image' + i +'-clear').addEventListener('click', () => {
        document.querySelector('#image' + i).value = '';        
        document.querySelector('#preview' + i).innerHTML = '<p class="text-center">画像はありません</p>';
    });

    //削除確認メッセージ
    document.querySelector('#image' + i + 'DeleteButton').addEventListener('click', () => {
        if(!confirm("削除してもよろしいですか？")) return false;
        document.querySelector('#preview' + i).innerHTML = '<p class="text-center">画像はありません</p>';
        document.querySelector('#file' + i).style.display = 'block';
        document.querySelector('#image' + i + 'DeleteButton').style.display = 'none';
        document.querySelector('#image' + i + 'Delete').value = 'true';
    });
}

//商品削除確認メッセージ
document.querySelector('#itemDelete').addEventListener('click', (event) => {
    if(!confirm("削除してもよろしいですか？")) return event.preventDefault();
});

</script>
