<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function showAllUser()
    {
        $users = DB::table('users')
            ->where('id', '!=', auth()->id())
            ->get();

        return view('users', compact('users'));
    }
}
