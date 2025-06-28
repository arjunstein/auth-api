<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use OpenApi\Annotations as OA;

class RefreshController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/refresh",
     *     summary="Refresh JWT token",
     *     tags={"Authenticate"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     )
     * )
     */
    public function __invoke()
    {
        $token = $this->authService->refreshToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully',
            'data' => ['token' => $token],
            'expires_in' => auth('api')->factory()->getTTL() * 120
        ], 200);
    }
}
