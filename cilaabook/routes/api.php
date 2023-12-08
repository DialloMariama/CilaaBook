<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route pour le projet
Route::post('storeProjet', [ProjetController::class, 'store'])->name('storeProjet');
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