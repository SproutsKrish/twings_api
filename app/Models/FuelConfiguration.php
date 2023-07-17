<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_imei',
        'fuel_a',
        'fuel_b',
        'fuel_c',
        'fuel_d',
        'fuel_limit',
        'fuel_average',
        'fuel_dip_ltr',
        'fuel_fill_ltr',
        'fuel_flag',
        'fuel_is_set',
        'fuel_model',
        'fuel_type',
        'fuel_tank_type',
        'fuel_tank_capacity',
        'fuel_odo',
        'fuel_tank',
        'status',
        'created_by',
        'updated_by'
    ];
}
