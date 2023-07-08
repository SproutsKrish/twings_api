<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'device_category',
        'certificate_id',
        'certificate_no',
        'device_id',
        'device_imei',
        'installed_date',
        'recalibration_date',
        'primary_mob_no',
        'secondary_mob_no',
        'invoice_date',
        'invoice_number',
        'panic_button',
        'rto_no',
        'state',
        'aadhaar_no',
        'image1',
        'image2',
        'image3',
        'qrimg',
        'dealer_id',
        'subdealer_id',
        'client_id',
        'status',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'ip_address',
    ];
}
