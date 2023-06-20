<?php

use App\Http\Controllers\Api\{
    LoginController,
    RegisterController,
    AdminDashboardController,
    UserDashboardController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('admin/details', [AdminDashboardController::class, 'details']);


// Admin Dashboard route
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
});

// User Dashboard route
Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserDashboardController::class, 'index']);
});
