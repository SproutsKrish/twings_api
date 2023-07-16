<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\VehicleService;

class VehicleServiceController extends Controller
{
    public function index()
    {
        $vehicle_services = VehicleService::all();

        if ($vehicle_services->isEmpty()) {
            return Helper::sendError('No vehicle services found.', [], 404);
        }

        return Helper::sendSuccess($vehicle_services);
    }

    public function store(Request $request)
    {
        $vehicle_service = VehicleService::create($request->all());

        if ($vehicle_service) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert vehicle service.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle_service = VehicleService::findOrFail($id);
            return Helper::sendSuccess($vehicle_service);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle service not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $vehicle_service = VehicleService::findOrFail($id);

            $vehicle_service->fill($request->only([
                'vehicle_id',
                'service_type',
                'purchase_product',
                'purchase_amount',
                'payment_mode',
                'mode_details',
                'purchase_date',
                'description',
                'reminder_date',
                'reminder_km',
                'client_id',
                'dealer_id',
                'subdealer_id',
                'status',
                'updated_by',
                'ip_address'
            ]));

            if ($vehicle_service->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update Vehicle service.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle service not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $vehicle_service = VehicleService::find($id);

        if (!$vehicle_service) {
            return Helper::sendError('Vehicle service not found.', [], 404);
        }
        if ($vehicle_service->delete()) {
            return Helper::sendSuccess('Vehicle service deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete Vehicle service.', [], 500);
        }
    }
}
