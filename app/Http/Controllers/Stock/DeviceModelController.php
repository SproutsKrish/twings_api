<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\DeviceModel;

class DeviceModelController extends Controller
{
    public function index()
    {
        $device_models = DeviceModel::all();

        if ($device_models->isEmpty()) {
            return Helper::sendError('No device models found.', [], 404);
        }

        return Helper::sendSuccess($device_models);
    }

    public function store(Request $request)
    {
        $device_model = DeviceModel::create($request->all());

        if ($device_model) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert device model.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device_model = DeviceModel::findOrFail($id);
            return Helper::sendSuccess($device_model);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device model not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device_model = DeviceModel::findOrFail($id);

            $device_model->fill($request->only([
                'device_model',
                'updated_by'
            ]));

            if ($device_model->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device model.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device model not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device_model = DeviceModel::find($id);

        if (!$device_model) {
            return Helper::sendError('Device Model not found.', [], 404);
        }
        if ($device_model->delete()) {
            return Helper::sendSuccess('Device Model deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete device model.', [], 500);
        }
    }
}
