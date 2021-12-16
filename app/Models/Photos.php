<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    /**
     * @var int|mixed
     */
    private $owner_id;
    /**
     * @var mixed
     */
    private $photo_name;
    /**
     * @var mixed
     */
    private $photo_path;
    /**
     * @var mixed
     */

}
