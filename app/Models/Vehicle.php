<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'vehicle_group',
        'vehicle_type_id',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'device_imei',
        'sim_mob_no',
        'insurance_company',
        'insurance_number',
        'insurance_start_date',
        'insurance_expiry_date',
        'tax_date',
        'registration_number',
        'chassis_number',
        'engine_number',
        'model_number',
        'ownership_type',
        'fc_date',
        'installation_date',
        'expire_date',
        'extend_date',
        'dealer_id',
        'subdealer_id',
        'client_id',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address',
    ];

    protected $dates = ['deleted_at'];
}
