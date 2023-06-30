<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Dealer;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Dealer::all();

        if ($dealers->isEmpty()) {
            return Helper::sendError('No dealers found.', [], 404);
        }

        return Helper::sendSuccess($dealers);
    }

    public function store(Request $request)
    {
        $dealer = Dealer::create($request->all());

        if ($dealer) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert dealer.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $dealer = Dealer::findOrFail($id);
            return Helper::sendSuccess($dealer);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Dealer not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dealer = Dealer::findOrFail($id);

            $dealer->fill($request->only([
                'dealer_company',
                'dealer_name',
                'dealer_email',
                'dealer_mobile',
                'dealer_address',
                'dealer_logo',
                'dealer_limit',
                'dealer_color',
                'dealer_subdomain',
                'dealer_city',
                'dealer_state',
                'dealer_pincode',
                'country_id',
                'country_name',
                'timezone_name',
                'timezone_minutes',
                'server_key',
                'status',
                'updated_by',
                'ip_address'
            ]));

            if ($dealer->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update dealer.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Dealer not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $dealer = Dealer::find($id);

        if (!$dealer) {
            return Helper::sendError('Dealer not found.', [], 404);
        }
        if ($dealer->delete()) {
            return Helper::sendSuccess('Dealer deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete dealer.', [], 500);
        }
    }
}
