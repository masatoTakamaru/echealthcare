<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productphoto;

class ProductphotoController extends Controller
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
        $file_name = $request->file('new-image')->getClientOriginalName();
        $product = Productphoto::find($request->id)->product;
        $product->productphotos()->create([
            'url' => 'storage/productPhotos/' . sprintf('%1$09d', $product->id) . '/' . $file_name,
        ]);

        $succeeded = $request->file('new-image')
            ->storeAs('public/productPhotos/' . sprintf('%1$09d', $product->id), $file_name);

        if($succeeded) {
            session()->flash('flashmessage', '画像を追加しました。');
        }

        return redirect()->route('admin.product.edit', [
            'product' => $product->id,
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
        $product = Productphoto::find($id)->product;
        $succeeded = Productphoto::destroy($id);

        if($succeeded) {
            session()->flash('flashmessage', '画像を削除しました。');
        }

        return redirect()->route('admin.product.edit', [
            'product' => $product->id,
        ]);
    }
}
