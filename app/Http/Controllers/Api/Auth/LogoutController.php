<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use OpenApi\Annotations as OA;

class LogoutController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Logout user (invalidate token)",
     *     tags={"Authenticate"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logout successfully")
     *         )
     *     )
     * )
     */
    public function __invoke()
    {
        $this->authService->logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }
}
