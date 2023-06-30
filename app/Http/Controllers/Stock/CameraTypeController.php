<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\CameraType;

class CameraTypeController extends Controller
{
    public function index()
    {
        $camera_types = CameraType::all();

        if ($camera_types->isEmpty()) {
            return Helper::sendError('No camera types found.', [], 404);
        }

        return Helper::sendSuccess($camera_types);
    }

    public function store(Request $request)
    {
        $camera_type = CameraType::create($request->all());

        if ($camera_type) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert camera type.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $camera_type = CameraType::findOrFail($id);
            return Helper::sendSuccess($camera_type);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera Type not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camera_type = CameraType::findOrFail($id);

            $camera_type->fill($request->only([
                'camera_type',
                'updated_by'
            ]));

            if ($camera_type->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera type.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera type not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $camera_type = CameraType::find($id);

        if (!$camera_type) {
            return Helper::sendError('Camera Type not found.', [], 404);
        }
        if ($camera_type->delete()) {
            return Helper::sendSuccess('Camera Type deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete camera type.', [], 500);
        }
    }
}
