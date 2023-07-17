<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Models\FuelConfiguration;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FuelConfigurationController extends Controller
{
    public function index()
    {
        $fuel_configuration = FuelConfiguration::all();

        if ($fuel_configuration->isEmpty()) {
            return Helper::sendError('No vehicle fuel configuration found.', [], 404);
        }

        return Helper::sendSuccess($fuel_configuration);
    }

    public function store(Request $request)
    {
        $fuel_configuration = new FuelConfiguration($request->all());
        if ($fuel_configuration->save()) {
            return Helper::sendSuccess("Vehicle fuel configuration inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update vehicle fuel configuration.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $fuel_configuration = FuelConfiguration::findOrFail($id);
            return Helper::sendSuccess($fuel_configuration);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle fuel configuration not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $fuel_configuration = FuelConfiguration::findOrFail($id);

            $fuel_configuration->fill($request->only([
                'vehicle_id',
                'device_imei',
                'fuel_a',
                'fuel_b',
                'fuel_c',
                'fuel_d',
                'fuel_limit',
                'fuel_average',
                'fuel_dip_ltr',
                'fuel_fill_ltr',
                'fuel_flag',
                'fuel_is_set',
                'fuel_model',
                'fuel_type',
                'fuel_tank_type',
                'fuel_tank_capacity',
                'fuel_odo',
                'fuel_tank',
                'updated_by',
            ]));

            if ($fuel_configuration->save()) {
                return Helper::sendSuccess("Vehicle fuel configuration updated Successfully !");
            } else {
                return Helper::sendError('Failed to Vehicle fuel configuration country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle fuel configuration not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $fuel_configuration = FuelConfiguration::find($id);

        if (!$fuel_configuration) {
            return Helper::sendError('Vehicle fuel configuration not found.', [], 404);
        }
        if ($fuel_configuration->delete()) {
            return Helper::sendSuccess('Vehicle fuel configuration deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle fuel configuration.', [], 500);
        }
    }
}
