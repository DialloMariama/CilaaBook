<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="CilaBook",
 *      description="Cette API va permettre de faire communiquer la partie frontale et la partie dorsale de notre plateforme",
 *      @OA\Contact(
 *          email="contact@exemple.com"
 *      ),
 *      @OA\License(
 *          name="Licence d'utilisation"
 *      )
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
