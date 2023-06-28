<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'subdealer_company',
        'subdealer_name',
        'subdealer_email',
        'subdealer_mobile',
        'subdealer_address',
        'subdealer_logo',
        'subdealer_limit',
        'subdealer_color',
        'subdealer_subdomain',
        'subdealer_city',
        'subdealer_state',
        'subdealer_country',
        'subdealer_pincode',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address'
    ];
}
