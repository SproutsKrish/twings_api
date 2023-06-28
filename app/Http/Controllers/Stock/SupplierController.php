<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        if ($suppliers->isEmpty()) {
            return Helper::sendError('No suppliers found.', [], 404);
        }

        return Helper::sendSuccess($suppliers);
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create($request->all());

        if ($supplier) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert supplier.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            return Helper::sendSuccess($supplier);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Supplier not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $supplier->fill($request->only([
                "supplier_name",
                "mobile_no",
                "email",
                "address",
                "city",
                "state",
                "pincode",
                "country",
                "updated_by"
            ]));

            if ($supplier->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update supplier.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Supplier not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return Helper::sendError('Supplier not found.', [], 404);
        }
        if ($supplier->delete()) {
            return Helper::sendSuccess('Supplier deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete supplier.', [], 500);
        }
    }
}
