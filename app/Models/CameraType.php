<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraType extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_type',
        'created_by',
        'updated_by'
    ];
}
