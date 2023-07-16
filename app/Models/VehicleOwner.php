<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_owner_company',
        'vehicle_owner_name',
        'vehicle_owner_email',
        'vehicle_owner_mobile',
        'vehicle_owner_address',
        'vehicle_owner_logo',
        'vehicle_owner_limit',
        'vehicle_owner_city',
        'vehicle_owner_state',
        'vehicle_owner_pincode',
        'country_id',
        'country_name',
        'timezone_name',
        'timezone_offset',
        'timezone_minutes',
        'client_id',
        'dealer_id',
        'subdealer_id',
        'status',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address'
    ];
}
