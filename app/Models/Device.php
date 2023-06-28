<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;


    protected $fillable = [
        'supplier_id',
        'device_type_id',
        'device_category_id',
        'device_model_id',
        'device_imei_no',
        'ccid',
        'uid',
        'start_date',
        'end_date',
        'sensor_name',

        'purchase_date',
        'dealer_id',
        'subdealer_id',
        'client_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
