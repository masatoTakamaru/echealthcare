<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserIndexController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc');

        return view('admin.auth.user-index', [
            'users' => $users->paginate(12)->onEachSide(0),
        ]);

    }
}
