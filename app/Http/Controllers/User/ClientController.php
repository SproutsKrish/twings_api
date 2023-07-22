<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        if ($clients->isEmpty()) {
            return Helper::sendError('No clients found.', [], 404);
        }

        return Helper::sendSuccess($clients);
    }

    public function store(Request $request)
    {
        $client = Client::create($request->all());

        if ($client) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert client.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $client = Client::findOrFail($id);
            return Helper::sendSuccess($client);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Client not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $client = Client::findOrFail($id);

            $client->fill($request->only([
                'client_company',
                'client_name',
                'client_email',
                'client_mobile',
                'client_address',
                'client_logo',
                'client_limit',
                'client_city',
                'client_state',
                'client_pincode',
                'country_id',
                'country_name',
                'timezone_name',
                'timezone_offset',
                'timezone_minutes',
                'api_key',
                'dealer_id',
                'subdealer_id',
                'status',
                'updated_by',
                'ip_address',
            ]));

            if ($client->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update client.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Client not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return Helper::sendError('Client not found.', [], 404);
        }
        if ($client->delete()) {
            return Helper::sendSuccess('Client deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete client.', [], 500);
        }
    }
}
