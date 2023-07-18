<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_no',
        'vehicle_id',
        'client_id',
        'dealer_id',
        'subdealer_id',
        'created_by',
        'updated_by',
    ];
}
