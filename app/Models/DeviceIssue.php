<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'vehicle_name',
        'chassis_number',
        'engine_number',
        'registration_number',
        'registration_date',
        'device_imei',
        'device_category',
        'device_model',
        'device_type',
        'ccid',
        'uid',
        'primary_mob_no',
        'secondary_mob_no',
        'state',
        'rto_number',
        'certificate_id',
        'certificate_no',
        'installed_date',
        'recalibration_date',
        'invoice_date',
        'invoice_number',
        'panic_button',
        'aadhaar_no',
        'image1',
        'image2',
        'image3',
        'qrimg',
        'dealer_id',
        'subdealer_id',
        'created_by',
        'updated_by'
    ];
}
