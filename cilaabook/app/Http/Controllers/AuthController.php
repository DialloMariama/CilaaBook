<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRegisterRequest;

class AuthController extends Controller
{
    /**
     
*@OA\Post(
*path="/api/register",
*summary="Cette url permet d'inscrire un utilisateur",
*tags={"Inscription des Utilisateurs"},
*@OA\RequestBody(
*required=true,
*@OA\JsonContent(
*@OA\Property(property="contenu", type="string", example="Inscription"),
*),
*),
*@OA\Response(
*response=200,
*description="Liste bailleurs affichée",
*),
*@OA\Response(
*response=401,
*description="Non autorisé",
*),
*)
*/
    public function enregistrerUtilisateur(StoreRegisterRequest $request)
    {
        $infoUtilisateurValide = $request->validated();
        $image = $request->file('image');
        if ($image !== null && !$image->getError()) {
            $infoUtilisateurValide['image'] = $image->store('images', 'public');
        }
        $infoUtilisateurValide['password'] = Hash::make($request->password);

        $user = User::create($infoUtilisateurValide);

        if ($user) {
            return response()->json([
                'staut' => 1,
                'message' => 'compte enregistré avec succè',
            ]);
        } else {
            return response()->json([
                'statut' => 0,
                'message' => 'compte non enregistré',
            ]);
        }
    }

    public function connecterUtilisateur(Request $request)
    {
        $request->validate([

            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return [
                'token' => $user->createToken(time())->plainTextToken,
                'user' => $user,
            ];
        } else {
            return response()->json([
                'error' => 'Unauthenticated',
                'message' => 'email ou mot de passe incorrecte ',

            ], 401);
        }
    }
    public function deconnecterUtilisateur(Request $request)
    {
        // auth()->logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json([
       
            'message' => 'deconnexion reussie',

        ], 200);

    }
}

