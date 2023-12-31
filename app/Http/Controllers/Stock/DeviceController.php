<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'device_imei_no' => 'required|unique:devices,device_imei_no',
            'ccid' => 'required|unique:devices,ccid',
            'uid' => 'required|unique:devices,uid'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return Helper::sendError('Validation failed.', $errors, 400);
        }

        $device = new Device($request->all());
        if ($device->save()) {
            return Helper::sendSuccess("Device inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update device.', [], 500);
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

            $validator = Validator::make($request->all(), [
                'device_imei_no' => 'required|unique:devices,device_imei_no',
                'ccid' => 'required|unique:devices,ccid',
                'uid' => 'required|unique:devices,uid'
            ]);

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

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return Helper::sendError('Validation failed.', $errors, 400);
            }

            $device = new Device($request->all());
            if ($device->save()) {
                return Helper::sendSuccess("Device updated Successfully !");
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
