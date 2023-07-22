<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\AccConfiguration;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AccConfigurationController extends Controller
{
    public function index()
    {
        $acc_configuration = AccConfiguration::all();

        if ($acc_configuration->isEmpty()) {
            return Helper::sendError('No vehicle acc configuration found.', [], 404);
        }

        return Helper::sendSuccess($acc_configuration);
    }

    public function store(Request $request)
    {
        $acc_configuration = new AccConfiguration($request->all());
        if ($acc_configuration->save()) {
            return Helper::sendSuccess("Vehicle acc configuration inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update vehicle acc configuration.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $acc_configuration = AccConfiguration::findOrFail($id);
            return Helper::sendSuccess($acc_configuration);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle acc configuration not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $acc_configuration = AccConfiguration::findOrFail($id);

            $acc_configuration->fill($request->only([
                'vehicle_id',
                'device_imei',
                'acc_date_time',
                'acc_flag',
                'acc_on',
                'acc_status',
                'updated_by',
            ]));

            if ($acc_configuration->save()) {
                return Helper::sendSuccess("Vehicle acc configuration updated Successfully !");
            } else {
                return Helper::sendError('Failed to Vehicle acc configuration country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle acc configuration not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $acc_configuration = AccConfiguration::find($id);

        if (!$acc_configuration) {
            return Helper::sendError('Vehicle acc configuration not found.', [], 404);
        }
        if ($acc_configuration->delete()) {
            return Helper::sendSuccess('Vehicle acc configuration deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle acc configuration.', [], 500);
        }
    }
}
