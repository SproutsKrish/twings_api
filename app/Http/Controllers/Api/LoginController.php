<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        //login user
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email Or Password is wrong !!!');
        }

        //send response
        return Helper::sendSuccess((new UserResource(auth()->user()))->loginRequest());
    }

    public function show($id)
    {
        // return Helper::sendSuccess((new UserResource(auth()->user()))->getUsersInfoByID($id));

        // Find the personal access token
        $accessToken = PersonalAccessToken::where('token', $id)->first();

        if ($accessToken) {
            // Retrieve the associated user
            $user = User::find($accessToken->tokenable_id);

            if ($user) {
                // User found
                return $user;
            }
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}
