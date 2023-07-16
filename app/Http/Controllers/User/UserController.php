<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\RegisterRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function store(RegisterRequest $request)
    {
        //register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'secondary_password' => bcrypt('twingszxc'),
            'role_id' => $request->role_id,
            'country_id' => $request->country_id,
            'country_name' => $request->country_name,
            'timezone_name' => $request->timezone_name,
            'timezone_offset' => $request->timezone_offset,
            'timezone_minutes' => $request->timezone_minutes,
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

    public function show(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                throw new AuthenticationException('Invalid token');
            }
            // User is authenticated and token is valid
            return Helper::sendSuccess($user);
        } catch (AuthenticationException $exception) {
            // Invalid token or user not found
            return Helper::sendError('Unauthorized', [], 401);
        } catch (UnauthorizedHttpException $exception) {
            // Invalid token format or other authentication error
            return Helper::sendError('Invalid token', [], 401);
        } catch (ModelNotFoundException $exception) {
            // User not found
            return Helper::sendError('No Data Found.', [], 404);
        }
    }

    public function update(Request $request)
    {
        try {
            // Get the authenticated user's ID
            $user = auth()->user();
            $id = $user->id;

            // Find the user record to update
            $user = User::findOrFail($id);

            // Validation rules
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],
            ]);

            // Validate the request data
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return Helper::sendError('Validation failed.', $errors, 400);
            }

            // Update the user details using the fill() method
            $user->fill($request->only([
                'name',
                'email',
                'password',
                'secondary_password',
                'role_id',
                'country_id',
                'ssstry_name',
                'timezone_name',
                'timezone_offset',
                'timezone_minutes',
                'updated_by',
                'ip_address' => request()->ip(),
            ]));

            // Save the updated user
            if ($user->save()) {
                return Helper::sendSuccess("User updated Successfully !");
            } else {
                return Helper::sendError('Failed to update user.', [], 500);
            }
        } catch (ModelNotFoundException $exception) {
            return Helper::sendError('User not found.', [], 404);
        }
    }
}
