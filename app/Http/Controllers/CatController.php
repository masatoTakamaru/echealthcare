<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;

class CatController extends Controller
{
    public function index($cat_id, $catsub_id = null)
    {
        $cat = Cat::find($cat_id);
        if ($catsub_id) {
            $catsub = $cat->catsubs->find($catsub_id);
            $products = $catsub->products()
                ->orderBy('id', 'desc');
            $amount = $products->count();
            
            return view('catsub', [
                'cat' => $catsub->cat,
                'catsub' => $catsub,
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
