<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\RolePermission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roleandpermission = RolePermission::all();

        if ($roleandpermission->isEmpty()) {
            return Helper::sendError('No role and permission found.', [], 404);
        }

        return Helper::sendSuccess($roleandpermission);
    }
}
