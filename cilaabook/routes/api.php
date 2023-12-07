<?php

use App\Http\Controllers\BailleurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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

Route::post('register',[PorteurprojetController::class,"create"]);
Route::post('login',[PorteurprojetController::class,"login"]);

Route::post('registerBailleur',[BailleurController::class,"create"]);
Route::post('loginBailleur',[BailleurController::class,"login"]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
