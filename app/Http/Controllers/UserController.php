<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
