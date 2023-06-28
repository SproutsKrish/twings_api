<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'camera_type_id',
        'camera_category_id',
        'camera_model_id',
        'device_imei_no',
        'serial_no',
        'id_no',

        'purchase_date',
        'dealer_id',
        'subdealer_id',
        'client_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
