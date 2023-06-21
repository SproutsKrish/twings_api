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

    public function store(Request $request)
    {
        $roleandpermission = RolePermission::create($request->all());

        if ($roleandpermission) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert role and permission.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $roleandpermission = RolePermission::findOrFail($id);
            return Helper::sendSuccess($roleandpermission);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }
}
