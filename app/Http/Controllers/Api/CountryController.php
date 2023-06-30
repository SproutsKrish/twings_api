<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Country;


class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        if ($countries->isEmpty()) {
            return Helper::sendError('No countries found.', [], 404);
        }

        return Helper::sendSuccess($countries);
    }

    public function store(Request $request)
    {
        $country = Country::create($request->all());

        if ($country) {
            return Helper::sendSuccess("Inserted Successfully");
        } else {
            return Helper::sendError('Failed to insert country.', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $country = Country::findOrFail($id);
            return Helper::sendSuccess($country);
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Country not found.', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $country = Country::findOrFail($id);

            $country->fill($request->only([
                'country_name',
                'country_code',
                'timezone_name',
                'timezone_minutes',
                'updated_by',
            ]));

            if ($country->save()) {
                return Helper::sendSuccess("Data Updated Successfully !");
            } else {
                return Helper::sendError('Failed to update country.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('Country not found.', [], 404);
        }
    }

    public function destroy($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return Helper::sendError('Country not found.', [], 404);
        }
        if ($country->delete()) {
            return Helper::sendSuccess('Country deleted successfully.');
        } else {
            return Helper::sendError('Failed to delete country.', [], 500);
        }
    }
}
