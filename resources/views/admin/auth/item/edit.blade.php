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
    <form action="{{ route('admin.item.update', ['item' => $item->id]) }}" method="POST">
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
        <tbody>
            @for($i = 1; $i <= 5; $i++)
                <tr class="border-2">
                    <td class="p-2">
                        @if($i == 1)
                            <p>メイン画像</p>
                        @endif
                    </td>
                    <td class="p-2">
                        <input type="file" id="image{{ $i }}" name="image{{ $i }}" value="{{ old('image' . $i) ?? $item)}} ">
                        <button type="button" id="image{{ $i }}-clear" class="bg-blue-200 py-1 px-4 rounded">削除</button>
                    </td>
                    <td id="preview{{ $i }}" class="p-2"><p>画像がありません</p></td>
                </tr>
            @endfor
        </tbody>
        </table>

        <input class="block mt-8 mb-10 bg-blue-200 py-2 px-4 rounded" type="submit" value="商品の更新">
    </form>
</section>
</x-app-layout>

<script>

for(let i = 1; i <= 5; i++) {
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
            document.querySelector('#image' + i).value = '';
        }
    }

    document.querySelector('#image' + i).addEventListener('onLoad', showPreview);    
    document.querySelector('#image' + i).addEventListener('change', showPreview);

    document.querySelector('#image' + i +'-clear').addEventListener('click', () => {
        document.querySelector('#image' + i).value = '';
        document.querySelector('#preview' + i).innerHTML = '<p>画像がありません</p>';
    });
}

</script>
