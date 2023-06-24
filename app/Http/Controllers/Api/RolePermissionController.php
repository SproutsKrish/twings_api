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
        try {
            $roleandpermission = RolePermission::create($request->all());
            return Helper::sendSuccess("Inserted Successfully");
        } catch (\Illuminate\Database\QueryException $e) {
            // Check if the exception is due to a duplicate entry error
            if ($e->getCode() === '23000') {
                return Helper::sendError('Role and permission already exists.', [], 400);
            } else {
                return Helper::sendError('Failed to insert role and permission.', [], 500);
            }
        }
    }


    public function show($roleId, $permissionId)
    {
        try {
            $roleandpermission = RolePermission::where('role_id', $roleId)
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

    public function update(Request $request, $roleId, $permissionId)
    {
        try {
            $rolePermission = RolePermission::where('role_id', $roleId)
                ->where('permission_id', $permissionId)
                ->first();

            if (!$rolePermission) {
                return Helper::sendError('Role permission not found.', [], 404);
            }

            // Update the specific columns
            $rolePermission->permission_id = $request->input('permission_id', $rolePermission->permission_id);
            $rolePermission->role_id = $request->input('role_id', $rolePermission->role_id);

            if ($rolePermission->save()) {
                return Helper::sendSuccess('Data updated successfully!');
            } else {
                return Helper::sendError('Failed to update role permission.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }

    public function destroy($roleId, $permissionId)
    {
        try {
            $rolePermission = RolePermission::where('role_id', $roleId)
                ->where('permission_id', $permissionId)
                ->first();

            if (!$rolePermission) {
                return Helper::sendError('Role permission not found.', [], 404);
            }

            if ($rolePermission->delete()) {
                return Helper::sendSuccess('Data deleted successfully!');
            } else {
                return Helper::sendError('Failed to delete role permission.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }
}
