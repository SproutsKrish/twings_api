<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_company',
        'dealer_name',
        'dealer_email',
        'dealer_mobile',
        'dealer_address',
        'dealer_logo',
        'dealer_limit',
        'dealer_city',
        'dealer_state',
        'dealer_pincode',
        'country_id',
        'country_name',
        'timezone_name',
        'timezone_offset',
        'timezone_minutes',
        'server_key',
        'status',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address',
    ];
}
