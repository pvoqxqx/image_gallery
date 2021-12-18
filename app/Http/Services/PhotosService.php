<?php

namespace App\Http\Services;

use App\Models\Photos;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PhotosService
 * @package App\Http\Services
 */
class PhotosService
{
    /**
     * @param int $id
     * @return Collection
     */
    public function showAll(int $id): Collection
    {
        if (!$id) {
            return collect();
        }

        return DB::table('photos')
            ->select('photo_name', 'photo_path')
            ->where('owner_id', $id)
            ->get();
    }

    /**
     * @param string $fileName
     * @return void
     */
    public function save(string $fileName): void
    {
        $photo = new Photos();

        $photo->owner_id = auth()->id();
        $photo->photo_name = $fileName;
        $photo->photo_path = 'storage/images/';

        $photo->save();
    }
}