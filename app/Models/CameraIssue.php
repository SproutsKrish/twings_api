<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraIssue extends Model
{
    use HasFactory;

    protected $table = 'camera_issues';

    protected $fillable = [
        'vehicle_id',
        'camera_category',
        'certificate_id',
        'certificate_no',
        'camera_id',
        'serial_no',
        'installed_date',
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
