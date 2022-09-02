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
            $mainimage_url = $item->itemimages->where('image_id', 1)->first()->url;
        }
        //在庫量が20以上なら在台購入数20まで
        $item->inventory >= 20 ? $max_quantity = 20 : $max_quantity = $item->inventory;
        $cat = $item->subcat->cat;

        return view('single', compact(
            'item',
            'mainimage_url',
            'max_quantity',
            'cat',
        ));
    }
}
