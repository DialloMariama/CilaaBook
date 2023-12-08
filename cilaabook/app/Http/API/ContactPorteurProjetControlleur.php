<?php

namespace App\Http\API;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Models\Porteurprojet;
use App\Models\BailleurProjet;
use App\Http\Controllers\Controller;
use App\Mail\MessageRendezVous;
use Illuminate\Support\Facades\Mail;
use App\Notifications\DemandeRendezVous;

class ContactPorteurProjetControlleur extends Controller
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
    public function store(Projet $projet, Request $request)
    {
        $BailleurConnecter=1;
     
        if($projet){
            
            $donneesFormulaire= $request->validate([
                'message'=>['required'],
            ]);
          
            $projetContacter= BailleurProjet::create([
                'bailleur_id' => $BailleurConnecter,
                'projet_id' => $projet->id,
            ]);
            if($projetContacter){
            
                $porteurProjetAContacter= Porteurprojet::where('id', $projet->porteurprojet_id)->first();
            
                Mail::to($porteurProjetAContacter->email)->send(new MessageRendezVous($donneesFormulaire));
               
                
                
                return response()->json(['message' => 'Le Mail envoyée avec succès']);
            }
        }else{
            return response()->json(['message' => 'Le Mail n\'a pas été envoyée ']);
        }


       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
