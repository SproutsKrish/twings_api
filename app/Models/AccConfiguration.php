<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_imei',
        'acc_date_time',
        'acc_flag',
        'acc_on',
        'acc_status',
        'status',
        'created_by',
        'updated_by'
    ];
}
