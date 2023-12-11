<?php

namespace App\Http\Controllers;

use App\Models\Porteurprojet;
use App\Http\Requests\StorePorteurprojetRequest;
use App\Http\Requests\UpdatePorteurprojetRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PorteurprojetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listePorteurProjet()
    {
      // $porteurpro = Porteurprojet::all();

    //return view('liste_pp', ['porteurpro' => $porteurpro]);
    try {
        $listePorteursProjet = Porteurprojet::all();

        return response()->json([
            'code_valide' => 200,
            'message' => 'La liste des porteurs de projets',
            'liste_des_porteurs_projet' => $listePorteursProjet,
        ], 200);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    //Redirection vers WhatSapp
    public function redirigerWhatsApp($id)
{
    try {
        // Validation de l'ID comme étant numérique
        if (!is_numeric($id)) {
            throw new Exception('L\'ID doit être numérique.');
        }

        $porteurProjet = Porteurprojet::findOrFail($id);
        $numeroWhatsApp = $porteurProjet->telephone;
        $urlWhatsApp = "https://api.whatsapp.com/send?phone=$numeroWhatsApp";

        return redirect()->to($urlWhatsApp);
    } catch (ModelNotFoundException $e) {
        return redirect()->route('whatsapp.porteur_project'); // Utilisez le bon nom de route
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
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
    public function store(StorePorteurprojetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Porteurprojet $porteurprojet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Porteurprojet $porteurprojet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePorteurprojetRequest $request, Porteurprojet $porteurprojet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Porteurprojet $porteurprojet)
    {
        //
    }
}
