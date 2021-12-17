<?php

namespace App\Http\Controllers;

use App\Http\Services\PhotosService;
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
    private PhotosService $photosService;

    /**
     * @param PhotosService $photosService
     */
    public function __construct(
        PhotosService $photosService
    ) {
        $this->photosService = $photosService;
    }

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

        $photos = $this->photosService->showAll($id);

        return view('user', compact('result', 'photos'));
    }
}
