<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Subdealer;

class SubdealerController extends Controller
{
    public function index()
    {
        $subdealers = Subdealer::all();

        if ($subdealers->isEmpty()) {
            return Helper::sendError('No subdealers found.', [], 404);
        }

        return Helper::sendSuccess($subdealers);
    }

    public function store(Request $request)
    {
        $subdealer = Subdealer::create($request->all());

        if ($subdealer) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert subdealer.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $subdealer = Subdealer::findOrFail($id);
            return Helper::sendSuccess($subdealer);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Subdealer not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $subdealer = Subdealer::findOrFail($id);

            $subdealer->fill($request->only([
                'dealer_id',
                'subdealer_company',
                'subdealer_name',
                'subdealer_email',
                'subdealer_mobile',
                'subdealer_address',
                'subdealer_logo',
                'subdealer_limit',
                'subdealer_color',
                'subdealer_subdomain',
                'subdealer_city',
                'subdealer_state',
                'subdealer_pincode',
                'country_id',
                'country_name',
                'timezone_name',
                'timezone_minutes',
                'status',
                'updated_by',
                'ip_address'
            ]));

            if ($subdealer->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update subdealer.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Subdealer not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $subdealer = Subdealer::find($id);

        if (!$subdealer) {
            return Helper::sendError('Subdealer not found.', [], 404);
        }
        if ($subdealer->delete()) {
            return Helper::sendSuccess('Subdealer deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete subdealer.', [], 500);
        }
    }
}
