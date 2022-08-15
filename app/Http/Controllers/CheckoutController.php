<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('checkout.index', [
            'user' => $user,
        ]);
    }

    public function succeed()
    {
        $user = Auth::user();
        $items = \Cart::session($user->id)
                    ->getContent();
        foreach($items as $item) {
            $user->purchases()->create([
                'product_id' => $item->associatedModel->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'pricesum' => $item->getPriceSum(),
            ]);
        }
        \Cart::clear();

        return view('checkout.succeed');
    }
}
