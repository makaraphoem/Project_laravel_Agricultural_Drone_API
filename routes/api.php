<?php
use App\Http\Controllers\FarmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DroneController;
<<<<<<< HEAD
use App\Http\Controllers\LocationController;
=======
use App\Http\Controllers\DroneTypeController;
>>>>>>> 404cb19ced8ca7ab6fff2266fa53c4f174f1eac9
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Models\DroneType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// PI user
Route::resource('/users', UserController::class);
//API Farm
Route::resource('/farms', FarmController::class);
Route::resource('/locations', LocationController::class);
Route::resource('/drones', DroneController::class);
Route::resource('/plans', PlanController::class);
Route::resource('/maps', MapController::class);
Route::resource('/droneTypes', DroneTypeController::class);


