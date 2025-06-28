<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthService;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Auth API",
 *     version="1.0.0"
 * )
 *
 * @OA\Tag(
 *     name="Auth"
 * )
 */
class RegisterController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Register new user",
     *     tags={"Authenticate"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"username", "name", "email", "password", "password_confirmation"},
     *                 @OA\Property(property="username", type="string", example="string"),
     *                 @OA\Property(property="name", type="string", example="string"),
     *                 @OA\Property(property="email", type="string", example="string"),
     *                 @OA\Property(property="password", type="string", example="string"),
     *                 @OA\Property(property="password_confirmation", type="string", example="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Register successful response"),
     *     @OA\Response(response=422, description="Unprocessable content")
     * )
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'data' => $data['user'],
            'token' => $data['token'],
        ], 201);
    }
}
