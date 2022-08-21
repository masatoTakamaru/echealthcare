<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productphoto;

class SingleController extends Controller
{
    public function index($id, Request $request)
    {
        $product = Product::find($id);
        if($request->another) {
            $mainphoto_url = Productphoto::find($request->another)->url;
        } else {
            $mainphoto_url = $product->primaryphoto_url;
        }
        //在庫量が20以上なら在台購入数20まで
        $product->inventory >= 20 ? $max_quantity = 20 : $max_quantity = $product->inventory;

        return view('single', [
            'product' => $product,
            'mainphoto_url' => $mainphoto_url,
            'max_quantity' => $max_quantity,
            'cat' => $product->subcat->cat,
        ]);
    }
}
