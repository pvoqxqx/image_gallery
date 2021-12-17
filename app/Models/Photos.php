<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Photos
 * @package App\Models
 * @property int $owner_id
 * @property string $photo_name
 * @property string $photo_path
 */
class Photos extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'photo_name',
        'photo_path',
    ];
}
