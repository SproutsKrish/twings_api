<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Models\AcConfiguration;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AcConfigurationController extends Controller
{
    public function index()
    {
        $ac_configuration = AcConfiguration::all();

        if ($ac_configuration->isEmpty()) {
            return Helper::sendError('No vehicle ac configuration found.', [], 404);
        }

        return Helper::sendSuccess($ac_configuration);
    }

    public function store(Request $request)
    {
        $ac_configuration = new AcConfiguration($request->all());
        if ($ac_configuration->save()) {
            return Helper::sendSuccess("Vehicle ac configuration inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update vehicle ac configuration.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $ac_configuration = AcConfiguration::findOrFail($id);
            return Helper::sendSuccess($ac_configuration);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle ac configuration not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ac_configuration = AcConfiguration::findOrFail($id);

            $ac_configuration->fill($request->only([
                'vehicle_id',
                'device_imei',
                'ac_date_time',
                'ac_flag',
                'ac_km',
                'updated_by',
            ]));


            if ($ac_configuration->save()) {
                return Helper::sendSuccess("Vehicle ac configuration updated Successfully !");
            } else {
                return Helper::sendError('Failed to Vehicle ac configuration country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle ac configuration not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $ac_configuration = AcConfiguration::find($id);

        if (!$ac_configuration) {
            return Helper::sendError('Vehicle ac configuration not found.', [], 404);
        }
        if ($ac_configuration->delete()) {
            return Helper::sendSuccess('Vehicle ac configuration deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle ac configuration.', [], 500);
        }
    }
}
