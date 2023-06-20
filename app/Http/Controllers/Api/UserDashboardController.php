<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Add your logic for the user dashboard here
        return response()->json([
            'message' => 'Welcome to the user dashboard!',
        ]);
    }
}
