<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Photos;

/**
 * Class PhotosController
 * @package App\Http\Controllers
 */
class PhotosController extends Controller
{
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
            $this->savePhotosPath($fileName);
        }

        return Redirect::back()->with('message', 'Operation Successful!');
    }

    /**
     * @param int $id
     * @return Collection|null
     */
    public function showAllPhotos(int $id): ?Collection
    {
        if (!$id) {
            return null;
        }

        return DB::table('photos')
            ->select('photo_name', 'photo_path')
            ->where('owner_id', $id)
            ->get();
    }

    /**
     * @param $fileName
     * @return void
     */
    private function savePhotosPath($fileName): void
    {
        if (!$fileName) {
            return;
        }

        var_dump(auth()->id());

        $photo = new Photos();

        $photo->owner_id = auth()->id();
        $photo->photo_name = $fileName;
        $photo->photo_path = 'storage/images/';

        $photo->save();
    }
}
