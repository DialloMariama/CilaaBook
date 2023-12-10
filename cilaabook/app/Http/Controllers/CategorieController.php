<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Http\Requests\ModifierCategorieRequest;

/**
 
*@OA\Tag(
*name="",
*description="Endpoints pour la suppression d'une categorie"
*)
*/
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
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
     
*@OA\Put(
*path="/api/modifierCategorie/{id}",
*summary="Cet endpoint permet de modifier une catégorie",
*tags={"Modifier Catégorie"},
*@OA\RequestBody(
*required=true,
*@OA\JsonContent(
*@OA\Property(property="contenu", type="string", example="modifier"),
*),
*),
*@OA\Response(
*response=200,
*description="Catégorie modifiée avec succès",
*),
*@OA\Response(
*response=401,
*description="Non autorisé",
*),
*)
*/

     
    public function update(ModifierCategorieRequest $request, $id)
    {
        try{
           
        $categorie=Categorie::findOrFail($id);
        $categorie->nom=$request->nom;
        $categorie->save();

        return response()->json([
        'status_code' =>200,
        'status_message' =>'la categorie est ajoutée avec succès',
        'data' =>$categorie
        ]);
    } catch (Exception $e) {
       return response()->json($e);
    }
    }

     /**
     
*@OA\Put(
*path="/api/supprimerCategorie/{categorie}",
*summary="Cet endpoint permet de supprimer une catégorie",
*tags={"Modifier Catégorie"},
*@OA\RequestBody(
*required=true,
*@OA\JsonContent(
*@OA\Property(property="contenu", type="string", example="supprimer"),
*),
*),
*@OA\Response(
*response=200,
*description="Catégorie supprimée avec succès",
*),
*@OA\Response(
*response=401,
*description="Non autorisé",
*),
*)
*/
    public function destroy(Categorie $categorie)
    {
        try{
            $categorie->delete();
            return response()->json([
                'status_code' =>200,
                'status_message' =>'la categorie a été supprimer avec succès',
                'data' =>$categorie
                ]);
            } catch (Exception $e) {
               return response()->json($e);
            }
            
    }
}
