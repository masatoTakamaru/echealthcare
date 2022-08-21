<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        $items = Purchase::all();

        return view('admin.auth.dashboard', [
            'items' => $items,
        ]);
    }
}
