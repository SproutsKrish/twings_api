<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        //login user
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email Or Password is wrong !!!');
        }

        //send response
        return Helper::sendSuccess(new UserResource(auth()->user()));
    }
}
