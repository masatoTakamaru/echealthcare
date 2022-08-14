<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Recommend;

class IndexController extends Controller
{
    public function index()
    {
        $new_items = Product::orderBy('id', 'desc')
            ->take(6)
            ->get();
        $recommend_ids = Recommend::all();
        $recommends = collect([]);
        foreach($recommend_ids as $id) {
            $recommends->push($id->product);
        }

        return view('index', [
            'new_items' => $new_items,
            'recommends' => $recommends,
        ]);
    }
}
