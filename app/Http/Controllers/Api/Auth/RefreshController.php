<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;

class RefreshController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
