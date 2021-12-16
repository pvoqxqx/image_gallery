<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUser(int $id)
    {
        $result = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('id', $id)
            ->get();

        $photos = (new PhotosController)->showAllPhotos($id);

        return view('user', compact(['result', 'photos']));
    }
}
