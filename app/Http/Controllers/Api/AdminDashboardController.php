<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Add your logic for the admin dashboard here
        return response()->json([
            'message' => 'Welcome to the admin dashboard!',
        ]);
    }
    public function details()
    {
        dd('Test');
    }
}
