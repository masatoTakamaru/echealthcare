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
            $main_photo = Productphoto::find($request->another);
        } else {
            $main_photo = $product->productphotos->first();
        }
        //在庫量が20以上なら在台購入数20まで
        $product->inventory >= 20 ? $max_quantity = 20 : $max_quantity = $product->inventory;

        return view('single', [
            'product' => $product,
            'main_photo' => $main_photo,
            'max_quantity' => $max_quantity,
        ]);
    }
}
