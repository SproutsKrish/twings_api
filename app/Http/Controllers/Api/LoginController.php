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

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // login user
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email Or Password is wrong !!!');
        }

        // send response
        return Helper::sendSuccess((new UserResource(auth()->user()))->loginRequest());
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return Helper::sendSuccess('Successfully logged out');


        // dd("OK");
    }
}
