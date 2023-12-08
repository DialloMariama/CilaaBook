<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bailleur;
use App\Models\Porteurprojet;
use App\Http\Requests\LoginUser;
use App\Http\Requests\LoginBailleur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreBailleurRequest;
use App\Http\Controllers\BailleurController;
use App\Http\Requests\UpdateBailleurRequest;
use App\Http\Controllers\PorteurprojetController;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(LoginUser $request)
    {
        try {
            if (!Auth::guard('web')->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            return response()->json([
                'status' => true,
                'message' => 'Admin connecté avec succés',
                'token' => Auth::guard('web')->user()->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function getAllBailleursUnblock()
    {
        $bailleurs = Bailleur::where('is_deleted', false)->get();
        return response()->json([
            'bailleurs' => $bailleurs,
        ], 200);
    }
    public function blockBailleur(Bailleur $bailleur)
    {
        $bailleur->is_deleted = 1;
        if ($bailleur->save()) {
            return response()->json([
                'statut' => '1',
                'message' => 'Bailleur bloquer.'
            ], 200);
        } else {
            return response()->json([
                'statut' => '0',
                'message' => 'Bailleur non bloquer.'
            ], 404);
        }
    }
    public function getAllBailleursBlock()
    {
        $bailleurs = Bailleur::where('is_deleted', true)->get();
        return response()->json([
            'bailleurs' => $bailleurs,
        ], 200);
    }
    public function unblockBailleur(Bailleur $bailleur)
    {
        $bailleur->is_deleted = 0;

        if ($bailleur->save()) {

            return response()->json([
                'statut' => '0',
                'message' => 'Bailleur debloquer.'
            ], 200);
        } else {
            return response()->json([
                'statut' => '1',
                'message' => 'Bailleur non bloquer.'
            ], 404);
        }
    }
    public function getAllPorteurprojetsUnblock()
    {
        $porteurprojets = Porteurprojet::where('is_deleted', false)->get();
        return response()->json([
            'porteurprojets' => $porteurprojets,
        ], 200);
    }
    public function blockPorteurprojet(Porteurprojet $porteurprojet)
    {
        $porteurprojet->is_deleted = 1;
        if ($porteurprojet->save()) {

            return response()->json([
                'statut' => '1',
                'message' => 'Porteur de projet bloquer.'
            ], 200);
        } else {
            return response()->json([
                'statut' => '0',
                'message' => 'Porteur de projet non bloquer.'
            ], 404);
        }
    }
    public function getAllPorteurprojetsBlock()
    {
        $porteurprojets = Porteurprojet::where('is_deleted', true)->get();
        return response()->json([
            'porteurprojets' => $porteurprojets,
        ], 200);
    }
    public function unblockPorteurprojet(Porteurprojet $porteurprojet)
    {
        $porteurprojet->is_deleted = 0;
        if ($porteurprojet->save()) {
            return response()->json([
                'statut' => '0',
                'message' => 'Porteur de projet debloquer.'
            ], 200);
        } else {
            return response()->json([
                'statut' => '1',
                'message' => 'Porteur de projet non bloquer.'
            ], 404);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Admin déconnecté avec succès']);
    }

    // public function logout(Request $request)
    // {


    //     // if (Auth::guard('web')->check()) {
    //     Auth::logout();
    //     $request->session()->invalidate();

    //     // $request->session()->regenerateToken();
    //     return response()->json(['message' => 'Admin deconnecté avec succès']);
    //     // }
    // }
}
