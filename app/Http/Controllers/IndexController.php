<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Itemimage;
use App\Models\Recommend;
use App\Models\Cat;

class IndexController extends Controller
{
    public function index()
    {
        $new_items = Item::orderBy('id', 'desc')
            ->take(6)
            ->get();
        $recommend_ids = Recommend::all();
        $recommends = collect([]);
        foreach($recommend_ids as $id) {
            $recommends->push($id->item);
        }
        $cats = Cat::all();

        return view('index', [
            'new_items' => $new_items,
            'recommends' => $recommends,
            'cats' => $cats,
        ]);
    }
}
