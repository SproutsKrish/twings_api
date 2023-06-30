<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\RolePermission;

use Illuminate\Support\Str;

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

    public function show($id)
    {
        try {
            $roleandpermission = RolePermission::findOrFail($id);
            return Helper::sendSuccess($roleandpermission);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $roleandpermission = RolePermission::findOrFail($id);

            $roleandpermission->fill($request->only([
                'role_id',
                'permission_id',
                'updated_by',
            ]));

            if ($roleandpermission->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update role and permission.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $roleandpermission = RolePermission::find($id);

        if (!$roleandpermission) {
            return Helper::sendError('Role and Permission not found.', [], 404);
        }
        if ($roleandpermission->delete()) {
            return Helper::sendSuccess('Role and Permission deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete role and permission.', [], 500);
        }
    }
}
