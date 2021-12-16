<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Photos;

class PhotosController extends Controller
{
    public function upload(Request $request)
    {
        // загрузка файла
        if ($request->isMethod('post') && $request->file('userfile')) {

            $file = $request->file('userfile');
            $uploadFolder = 'public/images/';
            $fileName = $file->getClientOriginalName();

            Storage::putFileAs($uploadFolder, $file, $fileName);
            $this->savePhotosPath($fileName);
        }

        return Redirect::back()->with('message','Operation Successful!');
    }

    public function showAllPhotos(int $id): ?\Illuminate\Support\Collection
    {
        if ($id) {
            return DB::table('photos')
                ->select('photo_name', 'photo_path')
                ->where('owner_id', $id)
                ->get();
        } else return null;
    }

    private function savePhotosPath($fileName)
    {
        if ($fileName) {
            $photo = new Photos;

            $photo->owner_id = auth()->id();
            $photo->photo_name = $fileName;
            $photo->photo_path = 'storage/images/';

            $photo->save();
        }
    }
}
