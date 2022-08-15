<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;

class CatController extends Controller
{
    public function index($cat_id, $subcat_id = null)
    {
        $cat = Cat::find($cat_id);
        if ($subcat_id) {
            $subcat = $cat->subcats->find($subcat_id);
            $products = $subcat->products()
                ->orderBy('id', 'desc');
            $amount = $products->count();
            
            return view('subcat', [
                'cat' => $subcat->cat,
                'subcat' => $subcat,
                'amount' => $amount,
                'products' => $products->paginate(12)->onEachSide(0),
            ]);
        } else {
            $products = $cat->products()
            ->orderBy('id', 'desc');
            $amount = $products->count();

            return view('category', [
                'cat' => $cat,
                'amount' => $amount,
                'products' => $products->paginate(12)->onEachSide(0),
            ]);    

        }
    }
}
