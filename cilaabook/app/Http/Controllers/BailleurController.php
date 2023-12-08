<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Http\Requests\LoginBailleur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreBailleurRequest;
use App\Http\Requests\UpdateBailleurRequest;

class BailleurController extends Controller
{
    public function create(StoreBailleurRequest $request)
    {
        try {    
           $bailleur = new bailleur();
           $bailleur-> nom = $request->nom;
           $bailleur-> email = $request->email;
           $bailleur-> telephone = $request->telephone;
           $bailleur-> password = Hash::make ($request->password);
           $bailleur-> adresse = $request->adresse;
           $bailleur-> statut = $request->statut;
           $image = $request->file('image');
           if ($image !== null && !$image->getError()) {
            $bailleur->image = $image->store('images', 'public');
           }
           $bailleur->save();  

            return response()->json([
                'status' => true,
                'message' => 'Le bailleur a bien été inscrit',
                'token' => $bailleur->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return Bailleur
     */
    public function login(LoginBailleur $request)
    {
        try {
            

            if(!Auth::guard('bailleur')->attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }


            return response()->json([
                'status' => true,
                'message' => 'Le bailleur est connecté avec succés',
                'token' =>Auth::guard('bailleur')->user()->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }
    public function logout()
    {
        Auth::guard('bailleur')->logout();
    
        return response()->json(['message' => 'Le baillleur est deconnecté avec succès']);
    }
    
}
