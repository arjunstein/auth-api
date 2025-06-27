<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
