<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="/login",
     *     tags={"auth"},
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="email as username",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="xxx@email.com"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="path",
     *         description="password",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="xxx"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns authentication response",
     *         @OA\JsonContent(
     *             @OA\Property(type="object", ref="#/components/schemas/AuthResponseData")
     *         ),
     *     ),
     * )
     */

    /**
     * @OA\Components(
     *     @OA\Schema(
     *         schema="AuthRequestData",
     *         @OA\Xml(name="AuthRequestData"),
     *         @OA\Property(property="email", type="string"),
     *         @OA\Property(property="password", type="string"),
     *     ),
     *     @OA\Schema(
     *         schema="AuthResponseData",
     *         @OA\Xml(name="AuthResponseData"),
     *         @OA\Property(property="access_token", type="string"),
     *         @OA\Property(property="token_type", type="string"),
     *         @OA\Property(property="expires_in", type="integer"),
     *     )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
