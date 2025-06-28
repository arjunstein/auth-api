<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use OpenApi\Annotations as OA;

class ProfileController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/profile",
     *     summary="Get detail user logged in",
     *     tags={"Authenticate"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User info",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="uuid", type="string", example=1),
     *                 @OA\Property(property="name", type="string", example="Arjun"),
     *                 @OA\Property(property="email", type="string", example="arjun@mail.com")
     *             )
     *         )
     *     )
     * )
     */
    public function __invoke()
    {
        return response()->json([
            'user' => $this->authService->me()
        ], 200);
    }
}
