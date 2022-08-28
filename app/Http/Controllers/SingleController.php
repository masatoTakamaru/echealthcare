<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Itemimage;

class SingleController extends Controller
{
    public function index($id, Request $request)
    {
        $item = Item::find($id);
        if($request->another) {
            $mainimage_url = Itemimage::find($request->another)->url;
        } else {
            $mainimage_url = $item->primaryimage_url;
        }
        //在庫量が20以上なら在台購入数20まで
        $item->inventory >= 20 ? $max_quantity = 20 : $max_quantity = $item->inventory;

        return view('single', [
            'item' => $item,
            'mainimage_url' => $mainimage_url,
            'max_quantity' => $max_quantity,
            'cat' => $item->subcat->cat,
        ]);
    }
}
