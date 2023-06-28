<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    use HasFactory;

    protected $fillable = [
        'network_id',
        'sim_imei_no',
        'sim_mob_no',
        'valid_from',
        'valid_to',

        'purchase_date',
        'dealer_id',
        'subdealer_id',
        'client_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
