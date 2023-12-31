<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'page_id',
        'name',
        'url_name',
        'guard_name',
        'created_by',
        'updated_by',
    ];
}
