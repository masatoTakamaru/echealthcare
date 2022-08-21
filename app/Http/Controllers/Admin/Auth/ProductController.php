<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Auth\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Productphoto;
use App\Models\Cat;

class ProductController extends Controller
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
            $items = Product::where('name', 'LIKE', "%$keyword%")->orderBy('id', 'desc');
        } elseif($cat_id) {
            $items = Product::where('cat_id', $cat_id)->orderBy('id', 'desc');
        } else {
            $items = Product::orderBy('id', 'desc');
        }
        $cats = Cat::all();

        return view('admin.auth.product.index', [
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

        return view('admin.auth.product.create', [
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
    public function store(ProductRequest $request)
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
        ]);

        $succeeded = Product::create($input);

        if($succeeded) {
            session()->flash('flashmessage', '商品を登録しました。');
        }

        return redirect()->route('admin.product.index');
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
        $item = Product::find($id);

        return view('admin.auth.product.edit', [
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
    public function update(ProductRequest $request, $id)
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

        $succeeded = Product::find($id)->update([
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

        if($succeeded) {
            session()->flash('flashmessage', '商品を更新しました。');
        }

        return redirect()->route('admin.product.index');
    }


    public function primaryphoto_update($id)
    {
        $productphoto = Productphoto::find($id);
        $product = $productphoto->product;
        $product->primaryphoto_url = $productphoto->url;
        $succeeded = $product->save();
 
        if($succeeded) {
            session()->flash('flashmessage', 'メイン画像を変更しました。');
        }

        return redirect()->route('admin.product.edit', [
            'product' => $product->id,
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
