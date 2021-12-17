<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function showUser(int $id)
    {
        $result = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('id', $id)
            ->get();

        $photos = (new PhotosController)->showAllPhotos($id);

        return view('user', compact('result', 'photos'));
    }
}
