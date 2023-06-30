<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\DeviceType;


class DeviceTypeController extends Controller
{

    public function index()
    {
        $device_types = DeviceType::all();

        if ($device_types->isEmpty()) {
            return Helper::sendError('No device types found.', [], 404);
        }

        return Helper::sendSuccess($device_types);
    }

    public function store(Request $request)
    {
        $device_type = DeviceType::create($request->all());

        if ($device_type) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert device type.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device_type = DeviceType::findOrFail($id);
            return Helper::sendSuccess($device_type);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device Type not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device_type = DeviceType::findOrFail($id);

            $device_type->fill($request->only([
                'device_type',
                'updated_by'
            ]));

            if ($device_type->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device type.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device type not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device_type = DeviceType::find($id);

        if (!$device_type) {
            return Helper::sendError('Device Type not found.', [], 404);
        }
        if ($device_type->delete()) {
            return Helper::sendSuccess('Device Type deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete device type.', [], 500);
        }
    }
}
