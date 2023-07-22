<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpmConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_imei',
        'rpm_a',
        'rpm_b',
        'rpm_c',
        'rpm_data',
        'rpm_idle',
        'rpm_max',
        'rpm_status',
        'status',
        'created_by',
        'updated_by'
    ];
}
