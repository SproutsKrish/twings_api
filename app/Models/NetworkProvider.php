<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'network_provider_name',
        'created_by',
        'updated_by'
    ];
}
