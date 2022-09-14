<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = Auth::user();

        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'last_name' => ['required', 'string', 'max:20'],
            'first_name' => ['required', 'string', 'max:20'],
            'last_name_kana' => ['required', 'string', 'max:20',
                                'regex:/\A[ァ-ヴー]+\z/u'],
            'first_name_kana' => ['required', 'string', 'max:20',
                                    'regex:/\A[ァ-ヴー]+\z/u'],
            'phone' => ['required', 'numeric', 'digits_between:10,11'],
            'zip' => ['required', 'numeric', 'digits:7'],
            'address' => ['required', 'string', 'max:80'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ], [
            'last_name_kana.regex' => '姓フリガナは全角カタカナで入力してください。',
            'first_name_kana.regex' => '名フリガナは全角カタカナで入力してください。',
        ]);

        $user = User::find($id)->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        return redirect()->route('user.updatesucceed');
    }

    public function updatesucceed()
    {
        return view('user.updatesucceed');
    }

    public function destroy($id)
    {
        Auth::logout();
        try {
            DB::beginTransaction();
            User::find($id)->delete();
            DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            \Log::error($e);
            throw $e;
        }
        
        return redirect()->route('user.index');
    }
}
