<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\CameraIssue;


class CameraIssueController extends Controller
{
    public function index()
    {
        $camera_issues = CameraIssue::all();

        if ($camera_issues->isEmpty()) {
            return Helper::sendError('No camera issues found.', [], 404);
        }

        return Helper::sendSuccess($camera_issues);
    }

    public function store(Request $request)
    {
        $camera_issue = CameraIssue::create($request->all());

        if ($camera_issue) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert camera issue.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $camera_issue = CameraIssue::findOrFail($id);
            return Helper::sendSuccess($camera_issue);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera issue not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camera_issue = CameraIssue::findOrFail($id);

            $camera_issue->fill($request->only([
                'vehicle_id',
                'camera_category',
                'certificate_id',
                'certificate_no',
                'camera_id',
                'serial_no',
                'installed_date',
                'rto_no',
                'state',
                'aadhaar_no',
                'image1',
                'image2',
                'image3',
                'qrimg',
                'dealer_id',
                'subdealer_id',
                'client_id',
                'status',
                'updated_by',
                'ip_address',
            ]));

            if ($camera_issue->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $camera_issue = CameraIssue::find($id);

        if (!$camera_issue) {
            return Helper::sendError('Camera Issue not found.', [], 404);
        }
        if ($camera_issue->delete()) {
            return Helper::sendSuccess('Camera Issue deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete camera issue.', [], 500);
        }
    }
}
