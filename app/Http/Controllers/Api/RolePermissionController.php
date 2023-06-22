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

    public function show($roleid, $permissionId)
    {
        try {
            $roleandpermission = RolePermission::where('role_id', $roleid)
                ->where('permission_id', $permissionId)
                ->first();

            if ($roleandpermission) {
                return Helper::sendSuccess($roleandpermission);
            } else {
                return Helper::sendError('Role and Permission not found.', [], 404);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }

    public function update(Request $request, $roleid, $permissionId)
    {
        try {
            $roleandpermission = RolePermission::where('role_id', $roleid)
                ->where('permission_id', $permissionId)
                ->first();

            $roleandpermission->fill($request->only([
                'permission_id',
                'role_id',
            ]));

            if ($roleandpermission->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }
}
