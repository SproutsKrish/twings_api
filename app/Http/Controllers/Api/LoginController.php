<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // // login user
        // if (!Auth::attempt($request->only('email', 'password'))) {
        //
        // }

        // // send response
        // return Helper::sendSuccess((new UserResource(auth()->user()))->loginRequest());


        $credentials = $request->only('email', 'password');

        // Check email in email column or name column
        $user = User::where(function ($query) use ($credentials) {
            $query->where('email', $credentials['email'])
                ->orWhere('name', $credentials['email'])
                ->orWhere('password', $credentials['password'])
                ->orWhere('secondary_password', $credentials['password']);
        })->first();

        if ($user) {
            // Password checks
            $passwordMatches = false;
            if (Hash::check($credentials['password'], $user->password) || Hash::check($credentials['password'], $user->secondary_password)) {
                $passwordMatches = true;
            } else {
                Helper::sendError('Email Or Password is wrong !!!');
            }

            if ($passwordMatches) {
                // Authentication successful
                // Generate an API token for the user if necessary
                $token = $user->createToken('API Token')->plainTextToken;
                // return response()->json(['token' => $token], 200);
                return Helper::sendSuccess($token);
            } else {
                Helper::sendError('Email Or Password is wrong !!!');
            }
        } else {
            Helper::sendError('Email Or Password is wrong !!!');
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return Helper::sendSuccess('Successfully logged out');
    }
}
