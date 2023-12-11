<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\BailleurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PorteurprojetController;
use App\Models\Porteurprojet;

use App\Http\API\ProjetController;
use App\Http\API\HomeControlleur;
use App\Http\API\ContactPorteurProjetControlleur;

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

Route::post('loginAdmin', [UserController::class, "login"]);
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {

    Route::get('PorteurprojetUnblock', [UserController::class, 'getAllPorteurprojetsUnblock']);
    Route::get('PorteurprojetBlock', [UserController::class, 'getAllPorteurprojetsBlock']);
    Route::get('blockPorteurprojet/{porteurprojet}', [UserController::class, 'blockPorteurprojet']);
    Route::get('unblockPorteurprojet/{porteurprojet}', [UserController::class, 'unblockPorteurprojet']);

    Route::get('BailleurUnblock', [UserController::class, 'getAllBailleursUnblock']);
    Route::get('BailleurBlock', [UserController::class, 'getAllBailleursBlock']);
    Route::get('blockBailleur/{bailleur}', [UserController::class, 'blockBailleur']);
    Route::get('unblockBailleur/{bailleur}', [UserController::class, 'unblockBailleur']);

    Route::post('logoutAdmin', [UserController::class, 'logout']);
});


Route::post('register', [PorteurprojetController::class, "create"]);
Route::post('loginPorteurrojet', [PorteurprojetController::class, "login"]);
Route::get('formLogin', [PorteurprojetController::class, "edit"])->name('login');
Route::middleware(['auth:sanctum', 'porteurprojet'])->group(function () {
    Route::post('storeProjet', [ProjetController::class, 'store'])->name('storeProjet');

    Route::post('logoutPorteurprojet', [PorteurprojetController::class, 'logout']);
});




Route::post('registerBailleur', [BailleurController::class, "create"]);
Route::post('loginBailleur', [BailleurController::class, "login"]);
Route::middleware(['auth:sanctum', 'bailleur'])->group(function () {
    Route::post('logoutBailleur', [BailleurController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route pour le projet
Route::post('deleteProjet/{projet}', [ProjetController::class, 'destroy'])->name('destroyProjet');
Route::get('showProjet/{projet}', [ProjetController::class, 'show'])->name('showProjet');
Route::post('updateProjet/{projet}', [ProjetController::class, 'update'])->name('updateProjet');
Route::get('editProjet/{projet}', [ProjetController::class, 'edit'])->name('editProjet');
Route::get('createProjet', [ProjetController::class, 'create'])->name('createProjet');
Route::get('indexProjet', [ProjetController::class, 'index'])->name('indexProjet');

// Route pour la page d'acceuille et la page details
Route::get('indexHome', [HomeControlleur::class, 'index'])->name('indexHome');
Route::get('showHome/{projet}', [HomeControlleur::class, 'show'])->name('showHome');
//Route pour gerer l'envoie des mails entre bayeur et porteur de projet
Route::post('storeContact/{projet}', [ContactPorteurProjetControlleur::class, 'store'])->name('storeContact');
