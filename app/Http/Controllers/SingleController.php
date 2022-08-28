<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Itemphoto;

class SingleController extends Controller
{
    public function index($id, Request $request)
    {
        $item = Item::find($id);
        if($request->another) {
            $mainphoto_url = Itemphoto::find($request->another)->url;
        } else {
            $mainphoto_url = $item->primaryphoto_url;
        }
        //在庫量が20以上なら在台購入数20まで
        $item->inventory >= 20 ? $max_quantity = 20 : $max_quantity = $item->inventory;

        return view('single', [
            'item' => $item,
            'mainphoto_url' => $mainphoto_url,
            'max_quantity' => $max_quantity,
            'cat' => $item->subcat->cat,
        ]);
    }
}
