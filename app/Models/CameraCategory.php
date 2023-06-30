<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_category',
        'created_by',
        'updated_by'
    ];
}
