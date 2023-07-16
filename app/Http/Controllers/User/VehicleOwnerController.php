<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\VehicleOwner;

class VehicleOwnerController extends Controller
{

    public function index()
    {
        $vehicle_owners = VehicleOwner::all();

        if ($vehicle_owners->isEmpty()) {
            return Helper::sendError('No vehicle owners found.', [], 404);
        }

        return Helper::sendSuccess($vehicle_owners);
    }

    public function store(Request $request)
    {
        $vehicle_owner = VehicleOwner::create($request->all());

        if ($vehicle_owner) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert vehicle owner.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle_owner = VehicleOwner::findOrFail($id);
            return Helper::sendSuccess($vehicle_owner);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle owner not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle_owner = VehicleOwner::findOrFail($id);

            $vehicle_owner->fill($request->only([
                'vehicle_owner_company',
                'vehicle_owner_name',
                'vehicle_owner_email',
                'vehicle_owner_mobile',
                'vehicle_owner_address',
                'vehicle_owner_logo',
                'vehicle_owner_limit',
                'vehicle_owner_city',
                'vehicle_owner_state',
                'vehicle_owner_pincode',
                'country_id',
                'country_name',
                'timezone_name',
                'timezone_offset',
                'timezone_minutes',
                'client_id',
                'dealer_id',
                'subdealer_id',
                'status',
                'updated_by',
                'ip_address'
            ]));

            if ($vehicle_owner->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update vehicle owner.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle owner not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $vehicle_owner = VehicleOwner::find($id);

        if (!$vehicle_owner) {
            return Helper::sendError('Vehicle owner not found.', [], 404);
        }
        if ($vehicle_owner->delete()) {
            return Helper::sendSuccess('Vehicle owner deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete vehicle owner.', [], 500);
        }
    }
}
