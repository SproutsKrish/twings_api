<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\CameraModel;

class CameraModelController extends Controller
{

    public function index()
    {
        $camera_models = CameraModel::all();

        if ($camera_models->isEmpty()) {
            return Helper::sendError('No camera models found.', [], 404);
        }

        return Helper::sendSuccess($camera_models);
    }

    public function store(Request $request)
    {
        $camera_model = CameraModel::create($request->all());

        if ($camera_model) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert camera model.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $camera_model = CameraModel::findOrFail($id);
            return Helper::sendSuccess($camera_model);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera Model not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camera_model = CameraModel::findOrFail($id);

            $camera_model->fill($request->only([
                'camera_model',
                'updated_by'
            ]));

            if ($camera_model->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera model.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera Model not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $camera_model = CameraModel::find($id);

        if (!$camera_model) {
            return Helper::sendError('Camera Model not found.', [], 404);
        }
        if ($camera_model->delete()) {
            return Helper::sendSuccess('Camera Model deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete camera model.', [], 500);
        }
    }
}
