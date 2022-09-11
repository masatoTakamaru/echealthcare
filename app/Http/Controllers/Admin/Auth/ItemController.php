<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\ItemRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Itemimage;
use App\Models\Cat;
use App\Models\Recommend;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $cat_id = (int)$request->cat_id;
        if($keyword) {
            $items = Item::where('name', 'LIKE', "%$keyword%")->orderBy('id', 'desc');
        } elseif($cat_id) {
            $items = Item::where('cat_id', $cat_id)->orderBy('id', 'desc');
        } else {
            $items = Item::orderBy('id', 'desc');
        }
        $cats = Cat::all();

        return view('admin.auth.item.index', [
            'keyword' => $keyword,
            'items' => $items->paginate(25)->onEachSide(0),
            'cats' => $cats,
            'cat_id' => $cat_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cats = Cat::all();
        $request->cat_id ? $current_cat_id = $request->cat_id : $current_cat_id = $cats->first()->id;

        return view('admin.auth.item.create', compact(
            'cats',
            'current_cat_id'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $request->validate([
            'image1' => ['required', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image2' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image3' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image4' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image5' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $input = $request->only([
            'header',
            'name',
            'serial',
            'price',
            'inventory',
            'spec',
            'cat_id',
            'subcat_id',
            'maker',
        ]);

        try {
            DB::beginTransaction();

            $item = Item::create($input);

            for($i = 1; $i <= 5; $i++) {
                if($request->file('image' . $i)) {
                    $file_name = $request->file('image' . $i)->getClientOriginalName();
                    $item_image = $request->file('image' . $i)
                        ->storeAs('public/itemPhotos/' . $item->id , $file_name);
                    $item->itemimages()->create([
                        'image_id' => $i,
                        'url' => $item->id . '/' . $file_name,
                    ]);
                }
            }
            DB::commit();
            session()->flash('flashmessage', '商品を登録しました。');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return redirect()->route('admin.item.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $cats = Cat::all();
        $request->cat_id ? $current_cat_id = $request->cat_id : $current_cat_id = $cats->first()->id;
        $item = Item::find($id);
        for($i = 1; $i <= 5; $i++) {
            $item->itemimages()->where('image_id', $i)->first() ? $up_images[$i] = true : $up_images[$i] = false;
        }
        //おすすめ商品の判定
        Recommend::where('item_id', $id)->count() ? $recommend = true : $recommend = false;

        return view('admin.auth.item.edit', compact(
            'cats',
            'current_cat_id',
            'item',
            'up_images',
            'recommend',
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $request->validate([
            'image1' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image2' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image3' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image4' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image5' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $input = $request->only([
            'header',
            'name',
            'serial',
            'price',
            'inventory',
            'spec',
            'cat_id',
            'subcat_id',
            'maker',
        ]);

        try {
            DB::beginTransaction();

            Item::find($id)->update($input);

            $item = Item::find($id);

            //画像ファイルの保存
            for($i = 1; $i <= 5; $i++) {
                //指定された画像を削除
                if($request->imageDelete[$i]) {
                    $image = $item->itemimages()->where('image_id', $i)->first();
                    Storage::disk('public')->delete('/itemPhotos/' . $image->url);
                    $item->itemimages()->where('image_id', $i)->first()->delete();
                }
                //ファイルが選択されている
                if($request->file('image' . $i)) {
                    $file_name = $request->file('image' . $i)->getClientOriginalName();
                    $request->file('image' . $i)
                        ->storeAs('public/itemPhotos/' . $item->id, $file_name);
                    $item->itemimages()->create([
                        'image_id' => $i,
                        'url' => $item->id . '/' . $file_name,
                    ]);
                }
            }

            DB::commit();
            session()->flash('flashmessage', '商品を更新しました。');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return redirect()->route('admin.item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            //画像ファイルの削除
            Storage::disk('public')->deleteDirectory('/itemPhotos/' . $id);

            Item::find($id)->delete();                        

            DB::commit();
            session()->flash('flashmessage', '商品を削除しました。');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return redirect()->route('admin.item.index');
    }
}
