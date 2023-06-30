<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\DeviceIssue;


class DeviceIssueController extends Controller
{
    public function index()
    {
        $device_issues = DeviceIssue::all();

        if ($device_issues->isEmpty()) {
            return Helper::sendError('No device issues found.', [], 404);
        }

        return Helper::sendSuccess($device_issues);
    }

    public function store(Request $request)
    {
        $device_issue = DeviceIssue::create($request->all());

        if ($device_issue) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert device issue.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $device_issue = DeviceIssue::findOrFail($id);
            return Helper::sendSuccess($device_issue);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device issue not device issue.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $device_issue = DeviceIssue::findOrFail($id);

            $device_issue->fill($request->only([
                'vehicle_type_id',
                'vehicle_make',
                'vehicle_model',
                'vehicle_year',
                'vehicle_name',
                'chassis_number',
                'engine_number',
                'registration_number',
                'registration_date',
                'device_imei',
                'device_category',
                'device_model',
                'device_type',
                'ccid',
                'uid',
                'primary_mob_no',
                'secondary_mob_no',
                'state',
                'rto_number',
                'installed_date',
                'recalibration_date',
                'invoice_date',
                'invoice_number',
                'panic_button',
                'aadhaar_no',
                'image1',
                'image2',
                'image3',
                'qrimg',
                'dealer_id',
                'subdealer_id',
                'updated_by',
            ]));

            if ($device_issue->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update device issue.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Device issue not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $device_issue = DeviceIssue::find($id);

        if (!$device_issue) {
            return Helper::sendError('Device issue not found.', [], 404);
        }
        if ($device_issue->delete()) {
            return Helper::sendSuccess('Device issue deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete device issue.', [], 500);
        }
    }
}
