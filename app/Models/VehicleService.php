<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'service_type',
        'purchase_product',
        'purchase_amount',
        'payment_mode',
        'mode_details',
        'purchase_date',
        'description',
        'reminder_date',
        'reminder_km',
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
