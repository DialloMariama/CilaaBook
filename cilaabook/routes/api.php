<?php

use App\Http\Controllers\BailleurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PorteurprojetController;
use App\Models\Porteurprojet;

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
Route::post('loginAdmin',[UserController::class,"login"]);
Route::middleware(['auth:sanctum', 'isAdmin'])->group ( function () {
    Route::post('logoutAdmin', [UserController::class, 'logout']);
    Route::get('getallPorteurprojet', [UserController::class,'getAllPorteurprojetsForAdmin']);
    Route::get('getallBailleur', [UserController::class,'getAllBailleursForAdmin']);

});




Route::post('register',[PorteurprojetController::class,"create"]);
Route::post('loginPorteurrojet',[PorteurprojetController::class,"login"]);
Route::get('formLogin',[PorteurprojetController::class,"edit"])->name('login');
Route::middleware(['auth:sanctum', 'porteurprojet'])->group ( function () {
    Route::post('logoutPorteurprojet', [PorteurprojetController::class, 'logout']);
});




Route::post('registerBailleur',[BailleurController::class,"create"]);
Route::post('loginBailleur',[BailleurController::class,"login"]);
Route::middleware(['auth:sanctum', 'bailleur'])->group ( function () {
    Route::post('logoutBailleur', [BailleurController::class, 'logout']);
 });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
