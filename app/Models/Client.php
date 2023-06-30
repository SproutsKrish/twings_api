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
        'client_alter_mobile',
        'client_logo',
        'client_limit',
        'role_id',
        'user_id',
        'dealer_id',
        'subdealer_id',
        'sms_title',
        'sms_url',
        'sms_username',
        'sms_password',
        'sms_access',
        'vehicle_access',
        'api_key',
        'fuel_email',
        'route_deviation',
        'personal_track',
        'client_address',
        'client_city',
        'client_state',
        'client_pincode',
        'country_id',
        'country_name',
        'timezone_name',
        'timezone_minutes',
        'short_name',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address'
    ];
}
