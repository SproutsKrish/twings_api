<?php

namespace App\Http\Controllers\stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\VehicleType;


class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicle_types = VehicleType::all();

        if ($vehicle_types->isEmpty()) {
            return Helper::sendError('No device types found.', [], 404);
        }

        return Helper::sendSuccess($vehicle_types);
    }

    public function store(Request $request)
    {
        $vehicle_type = VehicleType::create($request->all());

        if ($vehicle_type) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert vehicle type.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle_type = VehicleType::findOrFail($id);
            return Helper::sendSuccess($vehicle_type);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle Type not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle_type = VehicleType::findOrFail($id);

            $vehicle_type->fill($request->only([
                'vehicle_type',
                'updated_by'
            ]));

            if ($vehicle_type->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update vehicle type.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle type not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $vehicle_type = VehicleType::find($id);

        if (!$vehicle_type) {
            return Helper::sendError('Vehicle Type not found.', [], 404);
        }
        if ($vehicle_type->delete()) {
            return Helper::sendSuccess('Vehicle Type deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete vehicle type.', [], 500);
        }
    }
}
