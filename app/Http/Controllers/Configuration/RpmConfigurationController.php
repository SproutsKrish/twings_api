<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Models\RpmConfiguration;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RpmConfigurationController extends Controller
{
    public function index()
    {
        $rpm_configuration = RpmConfiguration::all();

        if ($rpm_configuration->isEmpty()) {
            return Helper::sendError('No vehicle rpm configuration found.', [], 404);
        }

        return Helper::sendSuccess($rpm_configuration);
    }

    public function store(Request $request)
    {
        $rpm_configuration = new RpmConfiguration($request->all());
        if ($rpm_configuration->save()) {
            return Helper::sendSuccess("Vehicle rpm configuration inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update vehicle rpm configuration.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $rpm_configuration = RpmConfiguration::findOrFail($id);
            return Helper::sendSuccess($rpm_configuration);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle rpm configuration not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rpm_configuration = RpmConfiguration::findOrFail($id);

            $rpm_configuration->fill($request->only([
                'vehicle_id',
                'device_imei',
                'rpm_a',
                'rpm_b',
                'rpm_c',
                'rpm_data',
                'rpm_idle',
                'rpm_max',
                'rpm_status',
                'updated_by',
            ]));

            if ($rpm_configuration->save()) {
                return Helper::sendSuccess("Vehicle rpm configuration updated Successfully !");
            } else {
                return Helper::sendError('Failed to Vehicle rpm configuration country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle rpm configuration not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $rpm_configuration = RpmConfiguration::find($id);

        if (!$rpm_configuration) {
            return Helper::sendError('Vehicle rpm configuration not found.', [], 404);
        }
        if ($rpm_configuration->delete()) {
            return Helper::sendSuccess('Vehicle rpm configuration deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle rpm configuration.', [], 500);
        }
    }
}
