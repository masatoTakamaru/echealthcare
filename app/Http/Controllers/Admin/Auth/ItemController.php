<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\ItemRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Itemphoto;
use App\Models\Cat;

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

        return view('admin.auth.item.create', [
            'cats' => $cats,
            'current_cat_id' => $current_cat_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
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
            'image1',
            'image2',
            'image3',
            'image4',
            'image5',
        ]);

        $request->validate([
            'image1' => ['required', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image2' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image3' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image4' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
            'image5' => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        dd($request->image1);

        try {
            DB::beginTransaction();

            $item = Item::find($request->id);

            for( $i = 1; $i <= 5; $i++) {
                $file_name = $request->file('image' . $i)->getClientOriginalName();
                $item->itemphotos()->create([
                    'url' => 'storage/itemPhotos/' . sprintf('%1$09d', $item->id) . '/' . $file_name,
                ]);
                $item_photo = $request->file('image' . $i)
                    ->storeAs('public/itemPhotos/' . sprintf('%1$09d', $item->id), $file_name);    
            }

        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        $item = Item::create($input);

        if($item) {
            session()->flash('flashmessage', '商品を登録しました。');
        }

        return redirect()->route('admin.item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('admin.auth.item.edit', [
            'cats' => $cats,
            'current_cat_id' => $current_cat_id,
            'item' => $item,
        ]);

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
            'image1',
            'image2',
            'image3',
            'image4',
            'image5',
        ]);

        $item = Item::find($id)->update([
            'header' => $request->header,
            'name' => $request->name,
            'serial' => $request->serial,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'spec' => $request->spec,
            'cat_id' => $request->cat_id,
            'subcat_id' => $request->subcat_id,
            'maker' => $request->maker,
        ]);

        if($item) {
            session()->flash('flashmessage', '商品を更新しました。');
        }

        return redirect()->route('admin.item.index');
    }


    public function primaryphoto_update($id)
    {
        $itemphoto = Itemphoto::find($id);
        $item = $itemphoto->item;
        $item->primaryphoto_url = $itemphoto->url;
        $succeeded = $item->save();
 
        if($succeeded) {
            session()->flash('flashmessage', 'メイン画像を変更しました。');
        }

        return redirect()->route('admin.item.edit', [
            'item' => $item->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
