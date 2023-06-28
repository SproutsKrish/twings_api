<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraIssue extends Model
{
    use HasFactory;

    protected $table = 'camera_issue';

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
        'rto_no',
        'issue_date',
        'camera_id',
        'camera_serial_no',
        'image1',
        'image2',
        'image3',
        'qrimg',
        'camera_category',
        'certificate_id',
        'certificate_no',
        'subdealer_id',
        'dealer_id',
        'client_id',
        'updated_by',
        'ip_address'
    ];
}
