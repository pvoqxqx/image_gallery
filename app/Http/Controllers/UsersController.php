<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function showAllUser()
    {
        $currentUserId = auth()->id();
        $users = DB::table('users')
            ->where('id', '!=', $currentUserId)
            ->get();

        return view('users', compact('users'));
    }
}
