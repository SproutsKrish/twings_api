<?php

use App\Http\Controllers\Api\{
    LoginController,
    UserController,
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
    DeviceIssueController,
    NetworkProviderController,
    VehicleController,
    VehicleTypeController
};


use App\Http\Controllers\user\{
    ClientController,
    DealerController,
    SubdealerController
};

use App\Http\Controllers\ImportController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Gate;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return new UserResource($request->user());
// });

Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout']);

Route::post('/logout', 'App\Http\Controllers\Api\LoginController@logout')->name('logout');


Route::post('register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('admin/dashboard', [AdminDashboardController::class, 'index']);
        //Country
        Route::resource('country', CountryController::class);
        //Role
        Route::resource('role', RoleController::class);
        //Permission
        Route::resource('permission', PermissionController::class);
        //RolePermission
        Route::resource('role_permission', RolePermissionController::class);
    });

    Route::middleware(['role:User'])->group(function () {
        Route::get('user/dashboard', [UserDashboardController::class, 'index']);
    });

    Route::middleware(['role:Admin'])->group(function () {

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

        //Camera Issue
        Route::resource('camera_issue', CameraIssueController::class);

        //Device Issue
        Route::resource('device_issue', DeviceIssueController::class);
    });
});

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


Route::post('/sim_import', 'App\Http\Controllers\ImportController@sim_import')->name('sim_import');

Route::post('/device_import', 'App\Http\Controllers\ImportController@device_import')->name('device_import');

Route::post('/camera_import', 'App\Http\Controllers\ImportController@camera_import')->name('camera_import');
