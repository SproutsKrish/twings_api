<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Device;


class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();

        if ($devices->isEmpty()) {
            return Helper::sendError('No devices found.', [], 404);
        }

        return Helper::sendSuccess($devices);
    }

    public function store(Request $request)
    {
        $device = Device::create($request->all());

        if ($device) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert device.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device = Device::findOrFail($id);
            return Helper::sendSuccess($device);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device = Device::findOrFail($id);

            $device->fill($request->only([
                "supplier_id",
                "device_type_id",
                "device_category_id",
                "device_model_id",
                "device_imei_no",

                "ccid",
                "uid",
                "start_date",
                "end_date",
                "sensor_name",

                "purchase_date",
                "updated_by"
            ]));

            if ($device->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return Helper::sendError('Device not found.', [], 404);
        }
        if ($device->delete()) {
            return Helper::sendSuccess('Device deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete device.', [], 500);
        }
    }

    public function saveassign(Request $request, $id)
    {
        try {
            $device = Device::findOrFail($id);

            $device->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($device->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device not found.', [], 404);
        }
    }

    public function deleteassign(Request $request, $id)
    {
        try {
            $device = Device::findOrFail($id);

            $device->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($device->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device not found.', [], 404);
        }
    }
}
