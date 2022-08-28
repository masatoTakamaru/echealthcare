<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Itemphoto;

class ItemphotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'new-image' => ['required', 'max:1024', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $file_name = $request->file('new-image')->getClientOriginalName();
        $item = Item::find($request->id);
        $item->itemphotos()->create([
            'url' => 'storage/itemPhotos/' . sprintf('%1$09d', $item->id) . '/' . $file_name,
        ]);

        $item_photo = $request->file('new-image')
            ->storeAs('public/itemPhotos/' . sprintf('%1$09d', $item->id), $file_name);

        if($item_photo) {
            session()->flash('flashmessage', '画像を追加しました。');
        }

        return redirect()->route('admin.item.edit', [
            'item' => $item->id,
        ]);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Itemphoto::find($id)->item;
        $succeeded = Itemphoto::destroy($id);

        if($succeeded) {
            session()->flash('flashmessage', '画像を削除しました。');
        }

        return redirect()->route('admin.item.edit', [
            'item' => $item->id,
        ]);
    }
}
