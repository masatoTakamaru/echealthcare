<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = Auth::user();

        return view('user.edit', [
            'user' => $user,
        ]);
    }
}
