<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recommend;
use App\Models\Item;

class RecommendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Recommend::all();

        return view('admin.auth.recommend.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->only('item_id');
            $recommend = Recommend::create($input);
            DB::commit();
            session()->flash('flashmessage', 'おすすめ商品として登録しました。');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Item::find($id)->delete();
            DB::commit();
            session()->flash('flashmessage', 'おすすめ商品の登録を解除しました');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return back();        
    }
}
