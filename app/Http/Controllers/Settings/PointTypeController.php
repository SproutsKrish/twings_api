<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\PointType;

class PointTypeController extends Controller
{
    public function index()
    {
        $point_types = PointType::all();

        if ($point_types->isEmpty()) {
            return Helper::sendError('No point types found.', [], 404);
        }

        return Helper::sendSuccess($point_types);
    }

    public function store(Request $request)
    {
        $point_type = new PointType($request->all());
        if ($point_type->save()) {
            return Helper::sendSuccess("Point Type inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update point type.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $point_type = PointType::findOrFail($id);
            return Helper::sendSuccess($point_type);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Point Type not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $point_type = PointType::findOrFail($id);

            $point_type->fill($request->only([
                'point_type',
                'subdealer_id',
                'updated_by',
            ]));

            if ($point_type->save()) {
                return Helper::sendSuccess("Point Type updated Successfully !");
            } else {
                return Helper::sendError('Failed to point type.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Point type not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $point_type = PointType::find($id);

        if (!$point_type) {
            return Helper::sendError('Point Type not found.', [], 404);
        }
        if ($point_type->delete()) {
            return Helper::sendSuccess('Point Type deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete point type.', [], 500);
        }
    }
}
