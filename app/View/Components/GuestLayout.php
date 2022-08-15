<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Cat;
use App\Models\Product;
use App\Models\Recommend;
use Illuminate\Support\Facades\Auth;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $cats = Cat::all();
        $new_items = Product::orderBy('id', 'desc')
            ->take(6)
            ->get();
        //dd($new_items->first()->productphotos);
        $recommend_ids = Recommend::all();
        $recommends = collect([]);
        foreach($recommend_ids as $id) {
            $recommends->push($id->product);
        }
        if(Auth::id()) \Cart::session(Auth::id());
        $cart_items = \Cart::getContent();

        return view('layouts.guest', [
            'cats' => $cats,
            'new_items' => $new_items,
            'recommends' => $recommends,
            'cart_items' => $cart_items,    
        ]);
    }
}
