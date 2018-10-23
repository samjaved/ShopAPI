<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/10/2018
 * Time: 5:27 AM
 */

namespace App\Controller\Admin;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Operation;

class LoginController
{
    /**
     * Retrieve a JWT token to use API methods that require an authentication.
     * @Operation(
     *     tags={"Authentication"},
     *     security={},
     *     @SWG\Parameter(
     *         name="credentials",
     *         in="body",
     *         @SWG\Schema(ref="#definitions/Login")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Login was successful",
     *         @SWG\Schema(ref="#definitions/Token")
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Bad credentials",
     *         @SWG\Schema(ref="#definitions/Error")
     *     )
     * )
     * @Rest\Post("/login")
     */
    public function login()
    {
    }

}