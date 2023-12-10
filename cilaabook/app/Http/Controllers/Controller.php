<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 
*@OA\Info(
*title="Api Cilabook",
*version="1.0.0",
*description="Cette API va permettre de faire communiquer la partie frontale et la partie dorsale de notre plateforme"
*)
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
