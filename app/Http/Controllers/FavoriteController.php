<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites();

        return view('favorite.index', [
            'user' => $user,
            'favorites' => $favorites->paginate(10)->onEachSide(0),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::id()) {

            $user = Auth::user();

            try {
                DB::beginTransaction();
                $user->favorites()->create([
                    'item_id' => $request->item_id
                ]);
                DB::commit();
                session()->flash('flashheader', 'お気に入り');
                session()->flash('flashmessage', 'お気に入りに登録しました。');
            } catch (\Throwable $e) {
                \DB::rollback();
                \Log::error($e);
                throw $e;
            }
    
            return back();
    
            
        } else {
            session()->flash('flashheader', 'ログインが必要です');
            session()->flash('flashmessage', '商品をお気に入りに登録するには、ログインが必要です。');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Favorite::find($id)->delete();
            DB::commit();
            session()->flash('flashmessage', 'お気に入りを削除しました。');
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }

        return back();
    }
}
