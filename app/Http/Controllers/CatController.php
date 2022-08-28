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
            $items = $subcat->items()
                ->orderBy('id', 'desc');
            $amount = $items->count();
            
            return view('subcat', [
                'cat' => $subcat->cat,
                'subcat' => $subcat,
                'amount' => $amount,
                'items' => $items->paginate(12)->onEachSide(0),
            ]);
        } else {
            $items = $cat->items()
            ->orderBy('id', 'desc');
            $amount = $items->count();

            return view('category', [
                'cat' => $cat,
                'amount' => $amount,
                'items' => $items->paginate(12)->onEachSide(0),
            ]);    

        }
    }
}
