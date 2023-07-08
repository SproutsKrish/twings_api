<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

use App\Models\Camera;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::all();

        if ($cameras->isEmpty()) {
            return Helper::sendError('No cameras found.', [], 404);
        }

        return Helper::sendSuccess($cameras);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serial_no' => 'required|unique:cameras,serial_no',
            'id_no' => 'required|unique:cameras,id_no'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return Helper::sendError('Validation failed.', $errors, 400);
        }

        $camera = new Camera($request->all());
        if ($camera->save()) {
            return Helper::sendSuccess("Camera inserted Successfully !");
        } else {
            return Helper::sendError('Failed to update camera.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $camera = Camera::findOrFail($id);
            return Helper::sendSuccess($camera);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $camera = Camera::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'serial_no' => 'required|unique:cameras,serial_no',
                'id_no' => 'required|unique:cameras,id_no'
            ]);

            $camera->fill($request->only([
                "supplier_id",
                "camera_type_id",
                "camera_category_id",
                "camera_model_id",
                "camera_imei_no",

                "serial_no",
                "id_no",

                "purchase_date",
                "updated_by"
            ]));

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return Helper::sendError('Validation failed.', $errors, 400);
            }

            $camera = new Camera($request->all());
            if ($camera->save()) {
                return Helper::sendSuccess("Camera updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $camera = Camera::find($id);

        if (!$camera) {
            return Helper::sendError('Camera not found.', [], 404);
        }
        if ($camera->delete()) {
            return Helper::sendSuccess('Camera deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete camera.', [], 500);
        }
    }

    public function saveassign(Request $request, $id)
    {
        try {
            $camera = Camera::findOrFail($id);

            $camera->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($camera->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera not found.', [], 404);
        }
    }

    public function deleteassign(Request $request, $id)
    {
        try {
            $camera = Camera::findOrFail($id);

            $camera->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($camera->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update camera.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Camera not found.', [], 404);
        }
    }
}
