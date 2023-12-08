<?php

namespace App\Http\Controllers;

use App\Models\Porteurprojet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePorteurprojetRequest;
use App\Http\Requests\UpdatePorteurprojetRequest;
use App\Http\Requests\LoginPorteurprojet;


class PorteurprojetController extends Controller
{
    public function create(StorePorteurprojetRequest $request)
    {
        try {    
           $porteurprojet = new Porteurprojet();
           $porteurprojet-> nom = $request->nom;
           $porteurprojet-> email = $request->email;
           $porteurprojet-> telephone = $request->telephone;
           $porteurprojet-> password = Hash::make ($request->password);
           $porteurprojet-> adresse = $request->adresse;
           $image = $request->file('image');
           if ($image !== null && !$image->getError()) {
            $porteurprojet->image = $image->store('images', 'public');
           }
           $porteurprojet->save();  

            return response()->json([
                'status' => true,
                'message' => 'Le porteur de projet a bien été inscrit',
                'token' => $porteurprojet->createToken("API TOKEN")->plainTextToken
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
    * @return Porteurprojet
     */
    public function login(LoginPorteurprojet $request)
    {
        try {
          

            if(!Auth::guard('porteurprojet')->attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            // $porteurprojet = Porteurprojet::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Le porteur de projet est connecté avec succés',
                'token' =>Auth::guard('porteurprojet')->user()->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function edit(){
        
       return response()->json([
            'status'=> true,
            'formLogin'=> route('login')
        ]) ;
    }

    public function logout()
{
    Auth::guard('porteurprojet')->logout(); // Utiliser 'bailleur' au lieu de 'api'

    return response()->json(['message' => 'Le porteur de projet est deconnecté avec succès']);
}

}
