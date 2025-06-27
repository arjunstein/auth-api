<?php

namespace App\Services\Auth;

use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService
{
    public function register(array $data): array;
    public function login(array $credentials): array;
    // add method refreshToken() if needed
    public function refreshToken(): string;
}
