<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_type_id',
        'total_point',
        'balance_point',
        'dealer_id',
        'subdealer_id',
        'created_by',
        'updated_by',
    ];
}
