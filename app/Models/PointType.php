<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointType extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_type',
        'created_by',
        'updated_by',
    ];
}
