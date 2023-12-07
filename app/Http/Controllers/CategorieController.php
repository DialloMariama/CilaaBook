<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

use Exception;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function lsite_categorie()
    {
        try {
            return response()->json([
            'code_valide' => 200,
            'message' => 'Les catégories ont été récupérés.',
            'liste des catégories' => Categorie:: all()
            ]);
            } catch (Exception $e) {
            return response() -> json($e);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        //Validation
        $request -> validate([
            'nom'
        ]);

        //Créer une catégorie
        $categorie = new Categorie();
        $categorie -> nom = $request -> nom;
        $categorie -> save(); 

        //renvoie de reponse personnalisée
        return response()->json([
            "message" => "Catégorie créer avec succéss"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    public function getCategorie($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}

