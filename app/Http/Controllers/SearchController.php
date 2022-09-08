<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Item;

class SearchController extends Controller
{
    public function index()
    {
        $items = null;
        $keyword = null;
        return view('search.index', compact(
            'items',
            'keyword',
        ));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword') ?? '';
        $pat = '%' . addcslashes($keyword, '%_\\') . '%';
        $items = Item::where('name', 'LIKE', $pat)
            ->paginate(10)
            ->onEachSide(0);
        
        return view('search.index', compact(
            'items',
            'keyword',
        ));
    }
}
