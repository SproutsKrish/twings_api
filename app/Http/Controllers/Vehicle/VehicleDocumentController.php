<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\VehicleDocument;

use Illuminate\Support\Facades\Storage;



class VehicleDocumentController extends Controller
{
    public function index()
    {
        $vehicle_documents = VehicleDocument::all();

        if ($vehicle_documents->isEmpty()) {
            return Helper::sendError('No vehicle documents found.', [], 404);
        }

        return Helper::sendSuccess($vehicle_documents);
    }

    public function store(Request $request)
    {
        $insurance_front_image_name = $request->input('insurance_front_image');
        $insurance_back_image = $request->input('insurance_back_image');

        $fitness_front_image = $request->input('fitness_front_image');
        $fitness_back_image = $request->input('fitness_back_image');
        $tax_front_image = $request->input('tax_front_image');
        $tax_back_image = $request->input('tax_back_image');
        $permit_front_image = $request->input('permit_front_image');
        $permit_back_image = $request->input('permit_back_image');
        $rc_front_image     = $request->input('rc_front_image');
        $rc_back_image = $request->input('rc_back_image');

        $fileContents = $request->getContent();

        $insurance_front_image_new_name = $request->input('vehicle_id') . '_' . 'insurance_front_image_name' . '.' . pathinfo($insurance_front_image_name, PATHINFO_EXTENSION);
        $insurance_back_image_new_name =  $request->input('vehicle_id') . '_' . 'insurance_back_image' . '.' . pathinfo($insurance_back_image, PATHINFO_EXTENSION);
        $fitness_front_new_image = $request->input('vehicle_id') . '_' . 'fitness_front_image' . '.' . pathinfo($fitness_front_image, PATHINFO_EXTENSION);
        $fitness_back_new_image = $request->input('vehicle_id') . '_' . 'fitness_back_image' . '.' . pathinfo($fitness_back_image, PATHINFO_EXTENSION);
        $tax_front_new_image = $request->input('vehicle_id') . '_' . 'tax_front_image' . '.' . pathinfo($tax_front_image, PATHINFO_EXTENSION);
        $tax_back_new_image = $request->input('vehicle_id') . '_' . 'tax_back_image' . '.' . pathinfo($tax_back_image, PATHINFO_EXTENSION);
        $permit_front_new_image = $request->input('vehicle_id') . '_' . 'permit_front_image' . '.' . pathinfo($permit_front_image, PATHINFO_EXTENSION);
        $permit_back_new_image = $request->input('vehicle_id') . '_' . 'permit_back_image' . '.' . pathinfo($permit_back_image, PATHINFO_EXTENSION);
        $rc_front_new_image = $request->input('vehicle_id') . '_' . 'rc_front_image' . '.' . pathinfo($rc_front_image, PATHINFO_EXTENSION);
        $rc_back_new_image = $request->input('vehicle_id') . '_' . 'rc_back_image' . '.' . pathinfo($rc_back_image, PATHINFO_EXTENSION);

        $success = file_put_contents(public_path('storage/uploads/' . $insurance_front_image_new_name), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $insurance_back_image_new_name), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $fitness_front_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $fitness_back_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $tax_front_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $tax_back_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $permit_front_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $permit_back_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $rc_front_new_image), $fileContents);
        $success = file_put_contents(public_path('storage/uploads/' . $rc_back_new_image), $fileContents);

        if ($success !== false) {
            $request->merge(['insurance_front_image' => $insurance_front_image_new_name]);
            $request->merge(['insurance_back_image' => $insurance_back_image_new_name]);
            $request->merge(['fitness_front_image' => $fitness_front_new_image]);
            $request->merge(['fitness_back_image' => $fitness_back_new_image]);
            $request->merge(['tax_front_image' => $tax_front_new_image]);
            $request->merge(['tax_back_image' => $tax_back_new_image]);
            $request->merge(['permit_front_image' => $permit_front_new_image]);
            $request->merge(['permit_back_image' => $permit_back_new_image]);
            $request->merge(['rc_front_image' => $rc_front_new_image]);
            $request->merge(['rc_back_image' => $rc_back_new_image]);

            $vehicle_document = VehicleDocument::create($request->all());

            if ($vehicle_document) {
                return Helper::sendSuccess("Inserted Successfully");
            } else {
                return Helper::sendError('Failed to insert vehicle document.', [], 500);
            }
        } else {
            return Helper::sendError('Failed to save the file.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $vehicle_document = VehicleDocument::findOrFail($id);
            return Helper::sendSuccess($vehicle_document);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle document not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dealer = VehicleDocument::findOrFail($id);

            $dealer->fill($request->only([
                'vehicle_id',
                'policy_no',
                'insurance_company_name',
                'insurance_type',
                'insurance_start_date',
                'insurance_expiry_date',
                'insurance_front_image',
                'insurance_back_image',
                'fitness_certificate_expiry_date',
                'fitness_front_image',
                'fitness_back_image',
                'tax_expiry_date',
                'tax_front_image',
                'tax_back_image',
                'permit_expiry_date',
                'permit_front_image',
                'permit_back_image',
                'rc_expiry_date',
                'rc_front_image',
                'rc_back_image',
                'status',
                'updated_by',
                'ip_address'
            ]));

            if ($dealer->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update vehicle document.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Vehicle document not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $vehicle_document = VehicleDocument::find($id);

        if (!$vehicle_document) {
            return Helper::sendError('Vehicle document not found.', [], 404);
        }
        if ($vehicle_document->delete()) {
            return Helper::sendSuccess('Vehicle document deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete vehicle document.', [], 500);
        }
    }
}
