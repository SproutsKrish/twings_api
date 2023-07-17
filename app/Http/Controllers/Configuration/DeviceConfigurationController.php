<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Models\DeviceConfiguration;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeviceConfigurationController extends Controller
{
    public function index()
    {
        $device_configuration = DeviceConfiguration::all();

        if ($device_configuration->isEmpty()) {
            return Helper::sendError('No vehicle device configuration found.', [], 404);
        }

        return Helper::sendSuccess($device_configuration);
    }

    public function store(Request $request)
    {
        $device_configuration = new DeviceConfiguration($request->all());
        if ($device_configuration->save()) {
            return Helper::sendSuccess("Vehicle device configuration inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update vehicle device configuration.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device_configuration = DeviceConfiguration::findOrFail($id);
            return Helper::sendSuccess($device_configuration);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle device configuration not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device_configuration = DeviceConfiguration::findOrFail($id);

            $device_configuration->fill($request->only([
                'vehicle_id',
                'device_imei',
                'device_assign_by',
                'device_assign_datetime',
                'device_time_updated',
                'device_time',
                'device_charge_status',
                'device_config_type',
                'device_type',
                'device_battery',
                'device_lock_id',
                'updated_by',
            ]));
            if ($device_configuration->save()) {
                return Helper::sendSuccess("Vehicle device configuration updated Successfully !");
            } else {
                return Helper::sendError('Failed to Vehicle device configuration country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle device configuration not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device_configuration = DeviceConfiguration::find($id);

        if (!$device_configuration) {
            return Helper::sendError('Vehicle device configuration not found.', [], 404);
        }
        if ($device_configuration->delete()) {
            return Helper::sendSuccess('Vehicle device configuration deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle device configuration.', [], 500);
        }
    }
}
