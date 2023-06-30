<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\DeviceCategory;


class DeviceCategoryController extends Controller
{
    public function index()
    {
        $device_categories = DeviceCategory::all();

        if ($device_categories->isEmpty()) {
            return Helper::sendError('No device categories found.', [], 404);
        }

        return Helper::sendSuccess($device_categories);
    }

    public function store(Request $request)
    {
        $device_category = DeviceCategory::create($request->all());

        if ($device_category) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert device category.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device_category = DeviceCategory::findOrFail($id);
            return Helper::sendSuccess($device_category);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device Category not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device_category = DeviceCategory::findOrFail($id);

            $device_category->fill($request->only([
                'device_category',
                'updated_by'
            ]));

            if ($device_category->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device category.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device category not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device_category = DeviceCategory::find($id);

        if (!$device_category) {
            return Helper::sendError('Device Category not found.', [], 404);
        }
        if ($device_category->delete()) {
            return Helper::sendSuccess('Device Category deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete device category.', [], 500);
        }
    }
}
