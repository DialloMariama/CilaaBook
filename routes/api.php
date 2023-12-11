<?php

use App\Http\Controllers\CategorieController;
use App\Models\Porteurprojet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PorteurprojetController;

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

                        //Création de notre API
                        
//Liste des catégorie
 Route::get('/listecate', [CategorieController::class, 'lsite_categorie']);
//Créer une catégorie
 Route::post('/creercate', [CategorieController::class, 'store']); 

 //Liste des porteurs de projet
 Route::get('/listePP', [PorteurprojetController::class, 'listePorteurProjet']);

 //redirection vers WhatsApp
 Route::get('/whatsapp/{id}', [PorteurprojetController::class, 'redirigerWhatsApp'])->name('whatsapp.porteur_project');