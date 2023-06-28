<?php

use App\Http\Controllers\Api\{
    LoginController,
    RegisterController,
    AdminDashboardController,
    UserDashboardController,
    CountryController,
    RoleController,
    PermissionController,
    RolePermissionController
};

use App\Http\Controllers\Stock\{
    SimController,
    DeviceController,
    CameraController,
    SupplierController,
    DeviceTypeController,
    DeviceCategoryController,
    DeviceModelController,
    CameraTypeController,
    CameraCategoryController,
    CameraIssueController,
    CameraModelController,
    NetworkProviderController,
    VehicleController,
    VehicleTypeController
};


use App\Http\Controllers\user\{
    ClientController,
    DealerController,
    SubdealerController
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
Route::post('user', [RegisterController::class, 'register']);

//User Details
Route::get('login/{id}', [LoginController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('user/dashboard', [UserDashboardController::class, 'index']);
    });
});

//Country
Route::resource('country', CountryController::class);

//Role
Route::resource('role', RoleController::class);

//Permission
Route::resource('role', PermissionController::class);

//RolePermission
Route::resource('roleandpermission', RolePermissionController::class);

//Network Provider
Route::resource('network', NetworkProviderController::class);

//Supplier
Route::resource('supplier', SupplierController::class);

//Device Type
Route::resource('device_type', DeviceTypeController::class);

//Device Category
Route::resource('device_category', DeviceCategoryController::class);

//Device Model
Route::resource('device_model', DeviceModelController::class);

//Camera Type
Route::resource('camera_type', CameraTypeController::class);

//Camera Category
Route::resource('camera_category', CameraCategoryController::class);

//Camera Model
Route::resource('camera_model', CameraModelController::class);

//Sim
Route::resource('sim', SimController::class);
Route::put('simsaveassign/{id}', [SimController::class, 'saveassign'])->name('sim.update');
Route::put('simdeleteassign/{id}', [SimController::class, 'deleteassign'])->name('sim.update');

//Device
Route::resource('device', DeviceController::class);
Route::put('devicesaveassign/{id}', [DeviceController::class, 'saveassign'])->name('device.update');
Route::put('devicedeleteassign/{id}', [DeviceController::class, 'deleteassign'])->name('device.update');

//Camera
Route::resource('camera', CameraController::class);
Route::put('camerasaveassign/{id}', [CameraController::class, 'saveassign'])->name('camera.update');
Route::put('cameradeleteassign/{id}', [CameraController::class, 'deleteassign'])->name('camera.update');

//Client
Route::resource('client', ClientController::class);

//Dealer
Route::resource('dealer', DealerController::class);

//SubDealer
Route::resource('subdealer', SubdealerController::class);

//Vehicle
Route::resource('vehicle', VehicleController::class);

//Vehicle Type
Route::resource('vehicle_type', VehicleTypeController::class);

//Camera Issue
Route::resource('camera_issue', CameraIssueController::class);
