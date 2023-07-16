<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'subdealer_company',
        'subdealer_name',
        'subdealer_email',
        'subdealer_mobile',
        'subdealer_address',
        'subdealer_logo',
        'subdealer_limit',
        'subdealer_city',
        'subdealer_state',
        'subdealer_pincode',
        'country_id',
        'country_name',
        'timezone_name',
        'timezone_offset',
        'timezone_minutes',
        'server_key',
        'dealer_id',
        'status',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address'
    ];
}
