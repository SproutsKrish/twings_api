<?php

namespace App\Http\Controllers\stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Vehicle;


class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        if ($vehicles->isEmpty()) {
            return Helper::sendError('No vehicles found.', [], 404);
        }

        return Helper::sendSuccess($vehicles);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());

        if ($vehicle) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert vehicle.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            return Helper::sendSuccess($vehicle);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);

            $vehicle->fill($request->only([
                'vehicle_name',
                'vehicle_group',
                'vehicle_type_id',
                'vehicle_make',
                'vehicle_model',
                'vehicle_year',
                'device_imei',
                'sim_mob_no',
                'insurance_company',
                'insurance_number',
                'insurance_start_date',
                'insurance_expiry_date',
                'tax_date',
                'registration_number',
                'chassis_number',
                'engine_number',
                'model_number',
                'ownership_type',
                'fc_date',
                'installation_date',
                'expire_date',
                'extend_date',
                'dealer_id',
                'subdealer_id',
                'client_id',
                'user_id',
                'updated_by',
                'ip_address'
            ]));

            if ($vehicle->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update vehicle.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return Helper::sendError('Vehicle not found.', [], 404);
        }
        if ($vehicle->delete()) {
            return Helper::sendSuccess('Vehicle deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete vehicle.', [], 500);
        }
    }
}
