<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_imei',
        'ac_date_time',
        'ac_flag',
        'ac_km',
        'status',
        'created_by',
        'updated_by'
    ];
}
