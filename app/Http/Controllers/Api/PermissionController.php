<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        if ($permissions->isEmpty()) {
            return Helper::sendError('No permissions found.', [], 404);
        }

        return Helper::sendSuccess($permissions);
    }

    public function store(Request $request)
    {
        $data = array_merge($request->all(), ['ip_address' => request()->ip()]);
        $role = Permission::create($data);

        if ($role) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert permission.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $role = Permission::findOrFail($id);
            return Helper::sendSuccess($role);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Permission not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Permission::findOrFail($id);

            $role->fill($request->only([
                'module_id',
                'page_id',
                'name',
                'url_name',
                'guard_name',
                'updated_by',
            ]));

            if ($role->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update permission.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Permission not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $role = Permission::find($id);

        if (!$role) {
            return Helper::sendError('Permission not found.', [], 404);
        }
        if ($role->delete()) {
            return Helper::sendSuccess('Permission deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete permission.', [], 500);
        }
    }
}
