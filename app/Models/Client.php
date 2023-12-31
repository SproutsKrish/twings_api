<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_company',
        'client_name',
        'client_email',
        'client_mobile',
        'client_address',
        'client_logo',
        'client_limit',
        'client_city',
        'client_state',
        'client_pincode',
        'country_id',
        'country_name',
        'timezone_name',
        'timezone_offset',
        'timezone_minutes',
        'api_key',
        'dealer_id',
        'subdealer_id',
        'status',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address',
    ];
}
