<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_imei',
        'device_assign_by',
        'device_assign_datetime',
        'device_time_updated',
        'device_time',
        'device_charge_status',
        'device_config_type',
        'device_type',
        'device_battery',
        'device_lock_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
