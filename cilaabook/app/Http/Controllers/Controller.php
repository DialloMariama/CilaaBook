<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;
   /**
 * @OA\Info(
 *      title="Nom de votre API",
 *      version="1.0.0",
 *      description="Description de votre API"
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
