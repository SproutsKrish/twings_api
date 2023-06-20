<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        if ($roles->isEmpty()) {
            return Helper::sendError('No roles found.', [], 404);
        }

        return Helper::sendSuccess($roles);
    }

    public function store(Request $request)
    {
        $data = array_merge($request->all(), ['ip_address' => request()->ip()]);
        $role = Role::create($data);

        if ($role) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert role.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $role = Role::findOrFail($id);
            return Helper::sendSuccess($role);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);

            $role->fill($request->only([
                'name',
                'guard_name',
                'updated_by',
            ]));

            if ($role->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update role.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Role not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return Helper::sendError('Role not found.', [], 404);
        }
        if ($role->delete()) {
            return Helper::sendSuccess('Role deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete role.', [], 500);
        }
    }
}
