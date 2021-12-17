<?php

namespace App\Http\Controllers;

use App\Http\Services\PhotosService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

/**
 * Class PhotosController
 * @package App\Http\Controllers
 */
class PhotosController extends Controller
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function upload(Request $request): RedirectResponse
    {
        $file = $request->file('userfile');
        if ($request->isMethod('post') && $file) {
            $uploadFolder = 'public/images/';
            $fileName = $file->getClientOriginalName();

            Storage::putFileAs($uploadFolder, $file, $fileName);
            $this->photosService->save($fileName);
        }

        return Redirect::back()->with('message', 'Operation Successful!');
    }
}
