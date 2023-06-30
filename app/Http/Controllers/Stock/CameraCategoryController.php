<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\CameraCategory;

class CameraCategoryController extends Controller
{
    public function index()
    {
        $camera_categories = CameraCategory::all();

        if ($camera_categories->isEmpty()) {
            return Helper::sendError('No camera categories found.', [], 404);
        }

        return Helper::sendSuccess($camera_categories);
    }

    public function store(Request $request)
    {
        $camera_category = CameraCategory::create($request->all());

        if ($camera_category) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert camera category.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $camera_category = CameraCategory::findOrFail($id);
            return Helper::sendSuccess($camera_category);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera Category not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camera_category = CameraCategory::findOrFail($id);

            $camera_category->fill($request->only([
                'camera_category',
                'updated_by'
            ]));

            if ($camera_category->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera category.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera Category not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $camera_category = CameraCategory::find($id);

        if (!$camera_category) {
            return Helper::sendError('Camera Category not found.', [], 404);
        }
        if ($camera_category->delete()) {
            return Helper::sendSuccess('Camera Category deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete camera category.', [], 500);
        }
    }
}
