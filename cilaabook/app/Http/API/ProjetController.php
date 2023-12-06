<?php

namespace App\Http\API;

use App\Models\Projet;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
        return response()->json([
            'statut'=>1,
           
            'projets' =>$projet = Projet::where('is_deleted', 0)
            ->where('porteurprojet_id', 1)
            ->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'statut'=>1,
           
            'form_url' => route('storeProjet'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjetRequest $request)
    {
        dump('route store');
        $donneeProjetValide = $request->validated();
        $image = $request->file('image');

        if ($image !== null && !$image->getError()) {
            $donneeProjetValide['image'] = $image->store('image', 'public');
        }
        $idPersonneConnecter=1;
        $donneeProjetValide['is_deleted']=0;
        $donneeProjetValide['porteurprojet']=$idPersonneConnecter;
        
        $projet = new Projet($donneeProjetValide);

        if ($projet->save()) {
            return response()->json([
                "status" => 1,
                "message" => "le projet à été enregistrer avec succès"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "le projet n'a pas été enregistrer"
            ]);
        }
    }


  
    




    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        if($projet){
            return response()->json([
                'statut'=>1,
                'projet' => $projet,
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
    public function edit(Projet $projet)
    {
        if($projet){
         
            return response()->json([
                'statut'=>1,
                'projet' => $projet,
                'form_url' => route('updateProjet', $projet->id),
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message' => "Erreur l'evenement non trouvé",
            ]); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {
        $donneeProjetValide = $request->validated();
        $image = $request->file('image');

        // $Even = Projet::findOrFail($id);

        if ($image !== null && !$image->getError()) {
            if ($projet->image) {
                Storage::disk('public')->delete($projet->image);
            }
            $donneeProjetValide['image'] = $image->store('image', 'public');
        }
        $idPersonneConnecter=1;
        $donneeProjetValide['porteurprojet']=$idPersonneConnecter;
        if ($projet->update($donneeProjetValide)) {
            return response()->json([
                "status" => 1,
                "message" => "le projet à été modifier avec succès"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "le projet n'a pas été modifier"
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        if($projet){
            $projet->is_deleted =1;
            
            if($projet->save()){
                return response()->json([
                    "status" => 1,
                    "message" => "le projet à été supprimer avec succès"
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "le projet n'a pas été supprimer"
                ]);
            }
        }
    }
}
