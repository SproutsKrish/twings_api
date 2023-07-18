<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\License;

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
        $license = new License($request->all());
        if ($license->save()) {
            return Helper::sendSuccess("License inserted Successfully !");
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
