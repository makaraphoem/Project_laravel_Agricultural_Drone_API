<?php
use App\Http\Controllers\FarmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DroneTypeController;
use App\Http\Controllers\IndructionController;
use App\Http\Controllers\LogInOutController as ControllersLogInOutController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Http\Resources\PlanResource;
use App\Models\LogInOutController;
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
// ___________________________________________________Route for log in create plan_______________
Route::middleware(['auth:sanctum'])->group(function(){
    Route::resource('/plans', PlanController::class);
    Route::post('/logOut', [ControllersLogInOutController::class, 'logout']);
});
Route::post('/logIn', [ControllersLogInOutController::class,'login']);
// __________________________Route for user, farm, location, drone, map, indruction_______________
Route::resource('/users', UserController::class);
Route::resource('/farms', FarmController::class);
Route::resource('/locations',LocationController::class);
Route::resource('/drones', DroneController::class);
Route::resource('/maps', MapController::class);
Route::resource('/indructions', IndructionController::class);

Route::get('/drone/{id}/{locationId}',[DroneController::class, 'droneLocation']);
Route::get('/map/{mapName}/{farmId}',[MapController::class, 'downloadMapPhoto']);
Route::delete('/map/{mapName}/{farmId}',[MapController::class, 'deleteMapPhoto']);
Route::put('/map/{mapName}/{farmId}',[MapController::class, 'addMapPhoto']);




