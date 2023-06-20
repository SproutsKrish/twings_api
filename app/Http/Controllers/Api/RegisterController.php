<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile_number' => $request->mobile_number,
            'alternate_mobile_number' => $request->alternate_mobile_number,
            'address' => $request->address,
            'licences' => $request->licences,
            'country_id' => $request->country_id,
            'created_by' => $request->created_by,
            'ip_address' => request()->ip()
        ]);

        //assign role
        $user_role = Role::where('name', 'user')->first();
        if ($user_role) {
            $user->assignRole($user_role);
        }

        return Helper::sendSuccess("Inserted Successfully");
    }
}
