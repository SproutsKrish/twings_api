<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\License;
use App\Models\Point;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::all();

        if ($licenses->isEmpty()) {
            return Helper::sendError('No licenses found.', [], 404);
        }

        return Helper::sendSuccess($licenses);
    }

    public function store(Request $request)
    {
        $client_id = $request->input('client_id');
        $dealer_id = $request->input('dealer_id');
        $subdealer_id = $request->input('subdealer_id');

        //admin license to client
        if ($client_id != null && $dealer_id == null && $subdealer_id == null) {

            $result = Point::where('balance_point', '>=', 1)
                ->where('dealer_id', null)
                ->where('subdealer_id', null)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->balance_point = $result->balance_point - 1;
                $result->save();
                $point = new License($request->all());
                $point->save();
                return Helper::sendSuccess("License Created Successfully");
            } else {
                return Helper::sendSuccess("License Created Failed");
            }
        }
        //dealer license to client
        else if ($client_id != null && $dealer_id != null && $subdealer_id == null) {

            $result = Point::where('balance_point', '>=', 1)
                ->where('dealer_id', $dealer_id)
                ->where('subdealer_id', null)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->balance_point = $result->balance_point - 1;
                $result->save();
                $point = new License($request->all());
                $point->save();
                return Helper::sendSuccess("License Created Successfully");
            } else {
                return Helper::sendSuccess("License Created Failed");
            }
        }
        //subdealer license to client
        else if ($client_id != null && $dealer_id != null && $subdealer_id != null) {

            $result = Point::where('balance_point', '>=', 1)
                ->where('dealer_id', $dealer_id)
                ->where('subdealer_id', $subdealer_id)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->balance_point = $result->balance_point - 1;
                $result->save();
                $point = new License($request->all());
                $point->save();
                return Helper::sendSuccess("License Created Successfully");
            } else {
                return Helper::sendSuccess("License Created Failed");
            }
        } else {
            return Helper::sendError('Failed to insert license.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $license = License::findOrFail($id);
            return Helper::sendSuccess($license);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('License not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $license = License::findOrFail($id);

            $license->fill($request->only([
                'license_no',
                'vehicle_id',
                'client_id',
                'dealer_id',
                'subdealer_id',
                'updated_by',
            ]));

            if ($license->save()) {
                return Helper::sendSuccess("License updated Successfully !");
            } else {
                return Helper::sendError('Failed to License.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('License not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $license = License::find($id);

        if (!$license) {
            return Helper::sendError('License not found.', [], 404);
        }
        if ($license->delete()) {
            return Helper::sendSuccess('License deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete License.', [], 500);
        }
    }
}
