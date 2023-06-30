<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'mobile_no',
        'email',
        'address',
        'city',

        'state',
        'pincode',
        'country',
        'created_by',
        'updated_by'
    ];
}
