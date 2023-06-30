<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
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
            'country_name' => $request->country_name,
            'timezone_name' => $request->timezone_name,
            'timezone_minutes' => $request->timezone_minutes,
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

    public function index(Request $request)
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }


    public function getUser(Request $request)
    {
        $user = Auth::guard('api')->user();

        // Perform additional logic if needed

        return response()->json($user);
    }
}
