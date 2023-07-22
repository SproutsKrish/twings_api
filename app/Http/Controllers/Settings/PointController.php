<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::all();

        if ($points->isEmpty()) {
            return Helper::sendError('No points found.', [], 404);
        }

        return Helper::sendSuccess($points);
    }

    public function store(Request $request)
    {
        $admin_id = $request->input('created_by');
        $dealer_id = $request->input('dealer_id');
        $subdealer_id = $request->input('subdealer_id');

        //admin new point
        if ($admin_id == '1' && $dealer_id == null && $subdealer_id == null) {

            $result = Point::where('subdealer_id', null)
                ->where('dealer_id', null)
                ->where('created_by', $admin_id)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->total_point = $result->total_point + $request->input('total_point');
                $result->balance_point = $result->balance_point + $request->input('balance_point');
                $result->save();
                return Helper::sendSuccess("Recharge Point Added Successfully");
            } else {
                $point = new Point($request->all());
                $point->save();
                return Helper::sendSuccess("New Point Added Successfully");
            }
        }
        //admin to dealer
        else  if ($admin_id == '1' && $dealer_id != null && $subdealer_id == null) {

            $result = Point::where('balance_point', '>=', $request->input('total_point'))
                ->where('dealer_id', null)
                ->where('subdealer_id', null)
                ->where('created_by', $admin_id)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->balance_point = $result->balance_point - $request->input('total_point');
                $result->save();
                $point = new Point($request->all());
                $point->save();
                return Helper::sendSuccess("Recharge Point Added Successfully");
            } else {
                return Helper::sendSuccess("Requested Point Not Available");
            }
        }
        //dealer to sub-dealer
        else  if ($dealer_id != null && $subdealer_id != null) {

            $result = Point::where('balance_point', '>=', $request->input('total_point'))
                ->where('subdealer_id', null)
                ->where('dealer_id', $dealer_id)
                ->where('status', 1)
                ->first();

            if (!empty($result)) {
                $result->balance_point = $result->balance_point - $request->input('total_point');
                $result->save();
                $point = new Point($request->all());
                $point->save();
                return Helper::sendSuccess("Recharge Point Added Successfully");
            } else {
                return Helper::sendSuccess("Requested Point Not Available");
            }
        } else {
            return Helper::sendError('Failed to update points.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $point = Point::findOrFail($id);
            return Helper::sendSuccess($point);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Point not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $point = Point::findOrFail($id);

            $point->fill($request->only([
                'license_no',
                'point_type_id',
                'total_point',
                'balance_point',
                'dealer_id',
                'subdealer_id',
                'updated_by',
            ]));

            if ($point->save()) {
                return Helper::sendSuccess("Point updated Successfully !");
            } else {
                return Helper::sendError('Failed to point.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Point not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $point = Point::find($id);

        if (!$point) {
            return Helper::sendError('Point not found.', [], 404);
        }
        if ($point->delete()) {
            return Helper::sendSuccess('Point deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete point.', [], 500);
        }
    }
}
