<?php

namespace App\Http\API;

use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeControlleur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return response()->json([
            'statu'=>1,
            'projet'=>Projet::orderBy('created_at', 'desc')->paginate(25)->where('is_deleted', 0),
        ]);
       
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
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        if($projet){
            return response()->json([
                'statu'=>1,
                'projet'=>$projet,
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message' => "Erreur l'evenement non trouvé",
            ]); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
