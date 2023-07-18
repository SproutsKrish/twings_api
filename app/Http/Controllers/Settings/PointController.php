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
        $point = new Point($request->all());
        if ($point->save()) {
            return Helper::sendSuccess("Points inserted Successfully !");
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
