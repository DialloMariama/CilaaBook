<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bailleur;
use App\Http\Requests\LoginUser;
use App\Http\Requests\LoginBailleur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreBailleurRequest;
use App\Http\Controllers\BailleurController;
use App\Http\Requests\UpdateBailleurRequest;
use App\Http\Controllers\PorteurprojetController;

class UserController extends Controller
{
    // public function create(StoreUserRequest $request)
    // {
    //     try {    
    //        $user = new User();
    //        $user-> name = $request->name;
    //        $user-> email = $request->email;
    //        $user-> password = Hash::make ($request->password);
    //        $user->save();  

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Lutilisateur a bien été inscrit',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken
    //         ], 200);

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(LoginUser $request)
    {
        try {
            

            if(!Auth::guard('web')->attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }


            return response()->json([
                'status' => true,
                'message' => 'Admin connecté avec succés',
                'token' =>Auth::guard('web')->user()->createToken("API TOKEN")->plainTextToken
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
        Auth::guard('web')->logout();
    
        return response()->json(['message' => 'Admin deconnecté avec succès']);
    }


    public function getAllPorteurprojetsForAdmin()
    {
        $porteurprojets = app(PorteurprojetController::class)->getAllPorteurprojets();

        return response()->json([
            'porteurprojets' => $porteurprojets,
        ], 200);
    }

    public function getAllBailleursForAdmin()
    {
        $bailleurs = app(BailleurController::class)->getAllBailleurs();

        return response()->json([
            'bailleurs' => $bailleurs,
        ], 200);
    }
    
}
