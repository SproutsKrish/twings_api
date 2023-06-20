<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'country_code',
        'timezone_name',
        'timezone_minutes',
    ];

    // Additional code can be added here


}
