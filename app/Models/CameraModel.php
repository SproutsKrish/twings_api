<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_model',
        'created_by',
        'updated_by'
    ];
}
