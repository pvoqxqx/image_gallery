<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Photos;

class PhotosController extends Controller
{
    public function upload(Request $request)
    {
        // загрузка файла
        if ($request->isMethod('post') && $request->file('userfile')) {

            $file = $request->file('userfile');
            $upload_folder = 'public/uploads/';
            $filename = $file->getClientOriginalName();

            Storage::putFileAs($upload_folder, $file, $filename);
            $this->savePhotosPath($filename, $upload_folder);
        }

        return view('home');
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

    private function savePhotosPath($photo_name, $photo_path)
    {
        if ($photo_name && $photo_path) {
            $photo = new Photos;

            $photo->owner_id = 2;
            $photo->photo_name = $photo_name;
            $photo->photo_path = $photo_path;
            $photo->save();
        }
    }
}
