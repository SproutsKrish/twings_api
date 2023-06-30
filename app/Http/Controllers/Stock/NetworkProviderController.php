<?php

namespace App\Http\Controllers\stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\NetworkProvider;


class NetworkProviderController extends Controller
{
    public function index()
    {
        $networks = NetworkProvider::all();

        if ($networks->isEmpty()) {
            return Helper::sendError('No networks found.', [], 404);
        }

        return Helper::sendSuccess($networks);
    }

    public function store(Request $request)
    {
        $network = NetworkProvider::create($request->all());

        if ($network) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert network.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $network = NetworkProvider::findOrFail($id);
            return Helper::sendSuccess($network);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Network not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $network = NetworkProvider::findOrFail($id);

            $network->fill($request->only([
                'network_provider_name',
                'updated_by'
            ]));

            if ($network->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update network.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Network not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $network = NetworkProvider::find($id);

        if (!$network) {
            return Helper::sendError('Network not found.', [], 404);
        }
        if ($network->delete()) {
            return Helper::sendSuccess('Network deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete network.', [], 500);
        }
    }
}
