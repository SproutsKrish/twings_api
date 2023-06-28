<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Sim;

class SimController extends Controller
{
    public function index()
    {
        $sims = Sim::all();

        if ($sims->isEmpty()) {
            return Helper::sendError('No sims found.', [], 404);
        }

        return Helper::sendSuccess($sims);
    }

    public function store(Request $request)
    {
        $sim = Sim::create($request->all());

        if ($sim) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert sim.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $sim = Sim::findOrFail($id);
            return Helper::sendSuccess($sim);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Sim not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $sim = Sim::findOrFail($id);

            $sim->fill($request->only([
                'network_id',
                'sim_imei_no',
                'sim_mob_no',
                'valid_from',
                'valid_to',
                'purchase_date',
                "dealer_id",
                "subdealer_id",
                "client_id",
                "updated_by"
            ]));

            if ($sim->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update sim.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Sim not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $sim = Sim::find($id);

        if (!$sim) {
            return Helper::sendError('Sim not found.', [], 404);
        }
        if ($sim->delete()) {
            return Helper::sendSuccess('Sim deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete sim.', [], 500);
        }
    }

    public function saveassign(Request $request, $id)
    {
        try {
            $sim = Sim::findOrFail($id);

            $sim->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($sim->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update sim.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Sim not found.', [], 404);
        }
    }

    public function deleteassign(Request $request, $id)
    {
        try {
            $sim = Sim::findOrFail($id);

            $sim->fill($request->only([
                "dealer_id",
                "subdealer_id",
                "client_id",
            ]));

            if ($sim->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update sim.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Sim not found.', [], 404);
        }
    }
}
