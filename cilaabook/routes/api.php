<?php

use Illuminate\Http\Request;
use App\Models\Porteurprojet;
use App\Http\API\HomeControlleur;
use App\Http\API\ProjetController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\RoleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;


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

Route::post('register', [AuthController::class, 'enregistrerUtilisateur']);
Route::post('/login', [AuthController::class, 'connecterUtilisateur']);
Route::get('/logout', [AuthController::class, 'deconnecterUtilisateur'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum','admin')->group(function(){
    Route::get('/utilisateurNonBloquer', [UserController::class, 'listeUtilisateurNonBloquer']);
    Route::get('/utilisateurBloquer', [UserController::class, 'listeUtilisateurBloquer']);

Route::get('toutPorteurNonBloquer', [UserController::class, 'toutPorteurNonBloquer']);
Route::get('toutBailleurNonBloquer', [UserController::class, 'toutBailleurNonBloquer']);
Route::post('bloquerUtilisateur/{user}', [UserController::class, 'bloquerUtilisateur']);
Route::get('toutPorteurBloquer', [UserController::class, 'toutPorteurBloquer']);
Route::get('toutBailleurBloquer', [UserController::class, 'toutBailleurBloquer']);
Route::post('debloquerUtilisateur/{user}', [UserController::class, 'debloquerUtilisateur']);


Route::apiResource('/categorie', CategorieController::class);
Route::apiResource('/role', RoleController::class);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

